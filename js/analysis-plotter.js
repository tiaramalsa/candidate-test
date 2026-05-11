'use strict';

/**
 * Plot result from the beam analysis calculation into a graph
 */
'use strict';
class AnalysisPlotter {
    constructor(container, title) {
        this.container = container;
        this.chart = null;
        this.title = title;
    }

    /**
     * Plot equation.
     *
     * @param {Object{beam : Beam, load : float, equation: Function}}  The equation data
     */
plot(data) {

        console.log('Plotting data : ', data);

        const beam = data.beam;
        const equation = data.equation;

        const points = [];

        for (let x = 0; x <= beam.primarySpan; x += 0.1) {

            const result = equation(x);

            points.push({
                x: result.x,
                y: result.y
            });
        }

        const ctx = this.container.getContext('2d');

        if (this.chart) {
            this.chart.destroy();
        }

        this.chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: points.map(point => point.x),
                datasets: [{
                    label: 'Beam Analysis',
                    data: points.map(point => point.y),
                    borderWidth: 2,
                    borderColor: 'blue',
                    pointRadius: 2,
                    fill: false,
                    tension: 0
                }]
            },
            options: {
                responsive: true,

                plugins: {
                    title: {
                        display: true,
                        text: this.title
                    }
                }
            }
        });
    }
}