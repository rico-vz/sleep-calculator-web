import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createApp, h } from 'vue';
import { ZiggyVue } from 'ziggy-js';
import { initializeTheme } from './composables/useAppearance';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const waitForCriticalStyles = async () => {
    if (typeof window === 'undefined') {
        return;
    }

    const links = Array.from(document.querySelectorAll<HTMLLinkElement>('link[rel="stylesheet"]')).filter(
        (link) => !link.href.includes('fonts.bunny.net'),
    );

    if (links.length === 0) {
        return;
    }

    await Promise.race([
        Promise.all(
            links.map(
                (link) =>
                    new Promise<void>((resolve) => {
                        if (link.sheet) {
                            resolve();
                            return;
                        }

                        const done = () => resolve();
                        link.addEventListener('load', done, { once: true });
                        link.addEventListener('error', done, { once: true });
                    }),
            ),
        ),
        new Promise<void>((resolve) => window.setTimeout(resolve, 1500)),
    ]);
};

const markAppReady = () => {
    if (typeof window === 'undefined') {
        return;
    }

    const root = document.documentElement;

    waitForCriticalStyles().finally(() => {
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                root.classList.remove('no-fouc');
                root.classList.add('fouc-ready');
            });
        });
    });
};

createInertiaApp({
    title: (title) => (title === appName ? title : `${title} - ${appName}`),
    resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob<DefineComponent>('./pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);

        markAppReady();
    },
    progress: {
        color: '#26cb68',
    },
});

// This will set light / dark mode on page load...
initializeTheme();
