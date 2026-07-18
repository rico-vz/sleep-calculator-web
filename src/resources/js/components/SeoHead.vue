<script lang="ts">
import { organizationSchema, type Schema, websiteSchema } from '@/lib/seo';
import { Head } from '@inertiajs/vue3';
import { computed, defineComponent, h } from 'vue';

export default defineComponent({
    props: {
        canonical: { type: String, required: true },
        description: { type: String, required: true },
        pageType: { type: String, default: 'WebPage' },
        robots: { type: String, default: 'index,follow' },
        schemas: { type: Array as () => Schema[], default: () => [] },
        title: { type: String, required: true },
        type: { type: String as () => 'article' | 'website', default: 'website' },
    },
    setup(props) {
        const siteName = 'SleepUtility';
        const origin = computed(() => new URL(props.canonical).origin);
        const schemaJson = computed(() =>
            JSON.stringify({
                '@context': 'https://schema.org',
                '@graph': [
                    organizationSchema(siteName, origin.value),
                    websiteSchema(siteName, origin.value),
                    {
                        '@type': props.pageType,
                        '@id': `${props.canonical}#webpage`,
                        url: props.canonical,
                        name: props.title,
                        description: props.description,
                        isPartOf: { '@id': `${origin.value}/#website` },
                    },
                    ...props.schemas,
                ],
            }).replace(/</g, '\\u003c'),
        );

        return () =>
            h(Head, { title: props.title }, () => [
                h('meta', { name: 'description', content: props.description }),
                h('meta', { name: 'robots', content: props.robots }),
                h('link', { rel: 'canonical', href: props.canonical }),
                h('meta', { property: 'og:type', content: props.type }),
                h('meta', { property: 'og:site_name', content: siteName }),
                h('meta', { property: 'og:url', content: props.canonical }),
                h('meta', { property: 'og:title', content: props.title }),
                h('meta', { property: 'og:description', content: props.description }),
                h('meta', { name: 'twitter:card', content: 'summary' }),
                h('meta', { name: 'twitter:title', content: props.title }),
                h('meta', { name: 'twitter:description', content: props.description }),
                h('script', { type: 'application/ld+json' }, schemaJson.value),
            ]);
    },
});
</script>
