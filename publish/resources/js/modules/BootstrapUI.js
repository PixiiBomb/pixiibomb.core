import * as bootstrap from 'bootstrap';

/**
 * PixiiBomb Bootstrap UI initializer.
 *
 * This module is intended to be copied into the host app and imported from resources/js/... by Vite.
 */
export default class BootstrapUI {
    /**
     * @param {Object} options
     * @param {string} options.tooltipSelector - CSS selector for tooltip triggers.
     * @param {string} options.tooltipTargetAttribute - Attribute holding the template element id.
     * @param {string} options.tooltipContainer - Bootstrap tooltip container.
     * @param {string} options.tooltipBoundary - Bootstrap tooltip boundary.
     * @param {{show:number, hide:number}} options.tooltipDelay - Tooltip show/hide delay.
     */
    constructor(options = {}) {
        this.options = {
            tooltipSelector: '[data-bs-toggle="tooltip"]',
            tooltipTargetAttribute: 'data-tooltip-target',
            tooltipContainer: 'body',
            tooltipBoundary: 'window',
            tooltipDelay: { show: 200, hide: 100 },
            ...options,
        };
    }

    /**
     * Initialize all enabled UI behaviors.
     */
    initialize() {
        this.initializeTooltips();
    }

    /**
     * Initialize Bootstrap tooltips using HTML templates.
     */
    initializeTooltips() {
        const {
            tooltipSelector,
            tooltipTargetAttribute,
            tooltipContainer,
            tooltipBoundary,
            tooltipDelay,
        } = this.options;

        document.querySelectorAll(tooltipSelector).forEach((el) => {
            const targetId = el.getAttribute(tooltipTargetAttribute);
            if (!targetId) return;

            const template = document.getElementById(targetId);
            if (!template) return;

            new bootstrap.Tooltip(el, {
                html: true,
                container: tooltipContainer,
                boundary: tooltipBoundary,
                title: template.innerHTML,
                delay: tooltipDelay,
            });
        });
    }
}
