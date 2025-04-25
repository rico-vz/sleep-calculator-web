<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { SharedData } from '@/types';
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
import { Separator } from "@/components/ui/separator";

const lastUpdatedDate = new Date('2025-04-18').toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
});

const props = defineProps<SharedData>();
</script>

<template>

    <Head>
        <title>Terms of Service</title>
        <!-- Generic -->
        <meta name="description"
            :content="`Read the Terms of Service for using ${props.name}, the sleep cycle calculator.`" />

        <!-- Search Engine -->
        <meta itemprop="name" :content="props.name" />
        <meta itemprop="description"
            :content="`Read the Terms of Service for using ${props.name}, the sleep cycle calculator.`" />

        <!-- OpenGraph -->
        <meta property="og:url" content="https://sleeputility.com/terms" />
        <meta property="og:type" content="website" />
        <meta property="og:title" :content="`Terms of Service - ${props.name}`" />
        <meta property="og:description"
            :content="`Read the Terms of Service for using ${props.name}, the sleep cycle calculator.`" />

        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" :content="`Terms of Service - ${props.name}`" />
        <meta name="twitter:description"
            :content="`Read the Terms of Service for using ${props.name}, the sleep cycle calculator.`" />
    </Head>
    <div class="flex min-h-screen flex-col">
        <Header :appName="props.name" :auth="props.auth" />
        <main class="flex-1">
            <div class="container max-w-4xl mx-auto py-16 px-4">
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold tracking-tight">
                        Terms of Service
                    </h1>
                    <p class="text-xl text-muted-foreground mt-4 max-w-2xl mx-auto">
                        Please read these terms carefully before using {{ props.name }}.
                    </p>
                </div>

                <div class="space-y-10">
                    <section>
                        <h2 class="text-2xl font-bold mb-4">1. Acceptance of Terms</h2>
                        <p class="text-muted-foreground mb-4">
                            By accessing or using {{ props.name }}, you agree to be bound by these Terms of Service. If
                            you do not agree to all the terms and conditions, you should not use this service.
                        </p>
                    </section>

                    <Separator />

                    <section>
                        <h2 class="text-2xl font-bold mb-4">2. Description of Service</h2>
                        <p class="text-muted-foreground mb-4">
                            {{ props.name }} provides tools and resources for calculating optimal sleep schedules based
                            on sleep cycle science. Our suggestions are for informational purposes only and should not
                            replace professional medical advice.
                        </p>
                    </section>

                    <Separator />

                    <section>
                        <h2 class="text-2xl font-bold mb-4">3. User Accounts</h2>
                        <p class="text-muted-foreground mb-4">
                            When you create an account with us, you must provide accurate information and keep it
                            updated. You are responsible for maintaining the confidentiality of your account and
                            password and for restricting access to your computer or device.
                        </p>
                    </section>

                    <Separator />

                    <section>
                        <h2 class="text-2xl font-bold mb-4">4. Intellectual Property</h2>
                        <p class="text-muted-foreground mb-4">
                            The content, organization, graphics, design, compilation, and other matters related to {{
                            props.name }} are protected by copyright, trademark, and other intellectual property rights.
                            You may not copy, modify, reproduce, republish, distribute, or sell any content from our
                            website without prior written consent.
                        </p>
                    </section>

                    <Separator />

                    <section>
                        <h2 class="text-2xl font-bold mb-4">5. Limitation of Liability</h2>
                        <p class="text-muted-foreground mb-4">
                            {{ props.name }} is provided on an "as is" and "as available" basis. We do not guarantee
                            that our service will be uninterrupted, timely, secure, or error-free. We will not be liable
                            for any direct, indirect, incidental, special, consequential, or punitive damages resulting
                            from your use of or inability to use the service.
                        </p>
                        <p class="text-muted-foreground mb-4">
                            Our sleep calculations are based on general scientific research and are not tailored to
                            individual health conditions. Always consult healthcare professionals for specific medical
                            advice.
                        </p>
                    </section>

                    <Separator />

                    <section>
                        <h2 class="text-2xl font-bold mb-4">6. Termination</h2>
                        <p class="text-muted-foreground mb-4">
                            We reserve the right to terminate or suspend your account and access to our services at our
                            sole discretion, without notice, for conduct that we believe violates these Terms of Service
                            or is harmful to other users, us, or third parties, or for any other reason.
                        </p>
                    </section>

                    <Separator />

                    <section>
                        <h2 class="text-2xl font-bold mb-4">7. Changes to Terms</h2>
                        <p class="text-muted-foreground mb-4">
                            We reserve the right to modify these terms at any time. We will provide notice of
                            significant changes by updating the date at the top of this policy and possibly by other
                            means. Your continued use of the service after such modifications will constitute your
                            acknowledgment of the modified terms.
                        </p>
                    </section>

                    <Separator />

                    <section>
                        <h2 class="text-2xl font-bold mb-4">8. Governing Law</h2>
                        <p class="text-muted-foreground mb-4">
                            These Terms shall be governed by and construed in accordance with applicable laws, without
                            regard to conflict of law principles.
                        </p>
                    </section>

                    <Separator />

                    <section>
                        <h2 class="text-2xl font-bold mb-4">9. Contact Us</h2>
                        <p class="text-muted-foreground mb-4">
                            If you have any questions about these Terms, please contact us at contact@sleeputility.com.
                        </p>
                        <p class="text-muted-foreground mb-4">
                            Last updated: {{ lastUpdatedDate }}
                        </p>
                    </section>
                </div>
            </div>
        </main>
        <Footer :appName="props.name" />
    </div>
</template>
