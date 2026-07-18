export type Schema = Record<string, unknown>;

export function organizationSchema(siteName: string, origin: string): Schema {
    return {
        '@type': 'Organization',
        '@id': `${origin}/#organization`,
        name: siteName,
        url: origin,
        logo: `${origin}/web-app-manifest-512x512.png`,
        sameAs: ['https://www.producthunt.com/posts/sleeputility'],
    };
}

export function websiteSchema(siteName: string, origin: string): Schema {
    return {
        '@type': 'WebSite',
        '@id': `${origin}/#website`,
        name: siteName,
        url: origin,
        publisher: { '@id': `${origin}/#organization` },
    };
}

export function webApplicationSchema(siteName: string, canonical: string, description: string): Schema {
    return {
        '@type': 'WebApplication',
        name: siteName,
        url: canonical,
        applicationCategory: 'UtilitiesApplication',
        operatingSystem: 'Web',
        description,
        publisher: { '@id': `${new URL(canonical).origin}/#organization` },
    };
}

export function blogSchema(siteName: string, canonical: string): Schema {
    return {
        '@type': 'Blog',
        name: `${siteName} Blog`,
        url: canonical,
        publisher: { '@id': `${new URL(canonical).origin}/#organization` },
    };
}

export function blogPostingSchema(
    post: {
        author: string;
        categories: string[];
        date: number;
        excerpt: string;
        tags: string[];
        title: string;
    },
    canonical: string,
): Schema {
    const origin = new URL(canonical).origin;

    return {
        '@type': 'BlogPosting',
        headline: post.title,
        description: post.excerpt,
        datePublished: new Date(post.date * 1000).toISOString(),
        author: {
            '@type': 'Organization',
            name: post.author,
            url: origin,
        },
        publisher: { '@id': `${origin}/#organization` },
        articleSection: post.categories,
        keywords: post.tags.join(', '),
        mainEntityOfPage: canonical,
    };
}

export function breadcrumbSchema(items: Array<{ name: string; url?: string }>): Schema {
    return {
        '@type': 'BreadcrumbList',
        itemListElement: items.map((item, index) => ({
            '@type': 'ListItem',
            position: index + 1,
            name: item.name,
            ...(item.url ? { item: item.url } : {}),
        })),
    };
}

export function faqPageSchema(items: Array<{ question: string; answer: string }>): Schema {
    return {
        '@type': 'FAQPage',
        mainEntity: items.map((item) => ({
            '@type': 'Question',
            name: item.question,
            acceptedAnswer: {
                '@type': 'Answer',
                text: item.answer,
            },
        })),
    };
}
