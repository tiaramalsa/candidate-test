'use strict';

/** ============================ Beam Analysis Data Type ============================ */

/**
 * Beam material specification.
 *
 * @param {String} name         Material name
 * @param {Object} properties   Material properties {EI : 0, GA : 0, ....}
 */
class Material {
    constructor(name, properties) {
        this.name = name;
        this.properties = properties;
    }
}

/**
 *
 * @param {Number} primarySpan          Beam primary span length
 * @param {Number} secondarySpan        Beam secondary span length
 * @param {Material} material           Beam material object
 */
class Beam {
    constructor(primarySpan, secondarySpan, material) {
        this.primarySpan = primarySpan;
        this.secondarySpan = secondarySpan;
        this.material = material;
    }
}

/** ============================ Beam Analysis Class ============================ */

class BeamAnalysis {
    constructor() {
        this.options = {
            condition: 'simply-supported'
        };

        this.analyzer = {
            'simply-supported': new BeamAnalysis.analyzer.simplySupported(),
            'two-span-unequal': new BeamAnalysis.analyzer.twoSpanUnequal()
        };
    }
    /**
     *
     * @param {Beam} beam
     * @param {Number} load
     */
    getDeflection(beam, load, condition) {
        var analyzer = this.analyzer[condition];

        if (analyzer) {
            return {
                beam: beam,
                load: load,
                equation: analyzer.getDeflectionEquation(beam, load)
            };
        } else {
            throw new Error('Invalid condition');
        }
    }
    getBendingMoment(beam, load, condition) {
        var analyzer = this.analyzer[condition];

        if (analyzer) {
            return {
                beam: beam,
                load: load,
                equation: analyzer.getBendingMomentEquation(beam, load)
            };
        } else {
            throw new Error('Invalid condition');
        }
    }
    getShearForce(beam, load, condition) {
        var analyzer = this.analyzer[condition];

        if (analyzer) {
            return {
                beam: beam,
                load: load,
                equation: analyzer.getShearForceEquation(beam, load)
            };
        } else {
            throw new Error('Invalid condition');
        }
    }
}




/** ============================ Beam Analysis Analyzer ============================ */

/**
 * Available analyzers for different conditions
 */
BeamAnalysis.analyzer = {};

/**
 * Calculate deflection, bending stress and shear stress for a simply supported beam
 *
 * @param {Beam}   beam   The beam object
 * @param {Number}  load    The applied load
 */
BeamAnalysis.analyzer.simplySupported = class {
    constructor(beam, load) {
        this.beam = beam;
        this.load = load;
    }
    getDeflectionEquation(beam, load) {
        return function (x) {
            const L = beam.primarySpan;
            const EI = beam.material.properties.EI;
            const j2 = beam.secondarySpan;
            return {
                x: x,
                y: 
                    -((load * x) / (24 * EI)) *
                (
                    Math.pow(L, 3)
                    - (2 * L * Math.pow(x, 2))
                    + Math.pow(x, 3)
                ) *
                j2 *
                1000
            };
        };
    }
    getBendingMomentEquation(beam, load) {
        return function (x) {
            const L = beam.primarySpan;
            return {
                x: x,
                y: ((load * x / 2) * (L -x )) * -1
            };
        };
    }
    getShearForceEquation(beam, load) {
        return function (x) {
            const L = beam.primarySpan;
            return {
                x: x,
                y: load * ((L / 2) - x)
            };
        };
    }
};


/**
 * Calculate deflection, bending stress and shear stress for a beam with two spans of equal condition
 *
 * @param {Beam}   beam   The beam object
 * @param {Number}  load    The applied load
 */
BeamAnalysis.analyzer.twoSpanUnequal = class {
    constructor(beam, load) {
        this.beam = beam;
        this.load = load;
    }
    getDeflectionEquation(beam, load) {
        return function (x) {
            const l1 = beam.primarySpan;
            const l2 = beam.secondarySpan;

            const EI = beam.material.properties.EI;

            // total span
            const L = l1 + l2;

            // distributed load
            const w = load;

            // reactions
            const R1 = (w * (l1 + l2)) / 2;
            const R2 = (w * (l1 + l2)) / 2;

            const EIeq = (EI / Math.pow(1000, 3));

            let y = 0;

            /**
             * REGION 1
             * 0 <= x <= l1
             */
            if (x >= 0 && x <= l1) {

                y =
                    (
                        (
                            4 * R1 * l1 * Math.pow(x, 2)
                        ) -
                        (
                            w * Math.pow(x, 3)
                        ) +
                        (
                            w * Math.pow(l1, 3)
                        ) -
                        (
                            4 * R1 * Math.pow(l1, 2)
                        )
                    ) *
                    x /
                    (24 * EIeq);

            }

            /**
             * REGION 2
             * l1 < x <= l1 + l2
             */
            else if (x > l1 && x <= L) {

                y =
                    (
                        (
                            (R1 * l1) / 6
                        ) *
                        (
                            Math.pow(x, 2) - Math.pow(l1, 2)
                        )
                    )
                    +
                    (
                        (R2 / 6) *
                        (
                            Math.pow(x, 3)
                            -
                            (3 * l1 * Math.pow(x, 2))
                            +
                            (3 * Math.pow(l1, 2) * x)
                        )
                    )
                    -
                    (
                        (R2 * Math.pow(l2, 3)) / 6
                    )
                    -
                    (
                        (w * x) / 24
                    ) *
                    (
                        Math.pow(x, 3)
                        -
                        Math.pow(l1, 3)
                    );

                y = y / EIeq;
            }

            y = y * 1000 * l2;

            return {
                x: x,
                y: y
            };
        };
    }
    getBendingMomentEquation(beam, load) {
        return function (x) {
          const L1 = beam.primarySpan;
            const L2 = beam.secondarySpan;
            const L = L1 + L2;

            const R1 = (load * L) / 2;
            const R2 = (load * L) / 2;

            let y = 0;

            if (x >= 0 && x <= L1) {

                y =
                    (R1 * x) -
                    ((load * Math.pow(x, 2)) / 2);

            } else if (x > L1 && x <= L) {

                y =
                    (R1 * x) +
                    (R2 * (x - L1)) -
                    ((load * Math.pow(x, 2)) / 2);
            }

            return {
                x: x,
                y: y
            };
        };
    }
    getShearForceEquation(beam, load) {
        return function (x) {
            const L1 = beam.primarySpan;
            const L2 = beam.secondarySpan;
            const L = L1 + L2;

            const R1 = (load * L) / 2;
            const R2 = (load * L) / 2;

            let y = 0;

            if (x === 0) {

                y = R1;

            } else if (x > 0 && x < L1) {

                y = R1 - (load * x);

            } else if (x === L1) {

                y = R1 + R2 - (load * L1);

            } else if (x > L1 && x < L) {

                y = R1 + R2 - (load * x);

            } else if (x === L) {

                y = R1 + R2 - (load * L);

            }

            return {
                x: x,
                y: y
            };
        };
    }
};
