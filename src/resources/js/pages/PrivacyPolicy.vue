<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { SharedData } from '@/types';
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
import { Separator } from "@/components/ui/separator";

const props = defineProps<SharedData>();

const lastUpdatedDate = new Date('2025-04-18').toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
});

</script>

<template>
    <Head title="Privacy Policy" />
    <div class="flex min-h-screen flex-col">
        <Header :appName="props.name" :auth="props.auth" />
        <main class="flex-1">
            <div class="container max-w-4xl mx-auto py-16 px-4">
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold tracking-tight">
                        Privacy Policy
                    </h1>
                    <p class="text-xl text-muted-foreground mt-4 max-w-2xl mx-auto">
                        How we collect, use, and protect your information
                    </p>
                </div>

                <div class="space-y-10">
                    <section>
                        <h2 class="text-2xl font-bold mb-4">1. Information We Collect</h2>
                        <p class="text-muted-foreground mb-4">
                            <span class="font-medium text-foreground">Account Information:</span> When you create an account, we collect your name, email address, and password.
                        </p>
                        <p class="text-muted-foreground mb-4">
                            <span class="font-medium text-foreground">Sleep Preferences:</span> We store your custom sleep preferences such as time to fall asleep.
                        </p>
                        <p class="text-muted-foreground mb-4">
                            <span class="font-medium text-foreground">Usage Data:</span> We collect information about how you interact with our website, including pages visited and features used.
                        </p>
                        <p class="text-muted-foreground mb-4">
                            <span class="font-medium text-foreground">Cookies and Similar Technologies:</span> We use cookies to enhance your experience, analyze site usage, and assist in our marketing efforts.
                        </p>
                    </section>

                    <Separator />

                    <section>
                        <h2 class="text-2xl font-bold mb-4">2. How We Use Your Information</h2>
                        <p class="text-muted-foreground mb-4">
                            We use the information we collect to:
                        </p>
                        <ul class="list-disc pl-6 space-y-2 text-muted-foreground mb-4">
                            <li>Provide, maintain, and improve our services</li>
                            <li>Create and manage your account</li>
                            <li>Personalize your sleep calculations based on your preferences</li>
                            <li>Send you updates, security alerts, and support messages</li>
                            <li>Analyze usage patterns to improve user experience</li>
                            <li>Detect, prevent, and address technical or security issues</li>
                        </ul>
                    </section>

                    <Separator />

                    <section>
                        <h2 class="text-2xl font-bold mb-4">3. Data Sharing and Disclosure</h2>
                        <p class="text-muted-foreground mb-4">
                            We do not sell your personal information to third parties. We may share your information in the following circumstances:
                        </p>
                        <ul class="list-disc pl-6 space-y-2 text-muted-foreground mb-4">
                            <li>With service providers who help us operate our business</li>
                            <li>To comply with legal obligations</li>
                            <li>To protect the rights, property, or safety of our users or others</li>
                            <li>In connection with a business transaction like a merger or acquisition</li>
                        </ul>
                    </section>

                    <Separator />

                    <section>
                        <h2 class="text-2xl font-bold mb-4">4. Data Security</h2>
                        <p class="text-muted-foreground mb-4">
                            We implement appropriate security measures to protect against unauthorized access, alteration, disclosure, or destruction of your personal information. However, no method of transmission over the Internet or electronic storage is 100% secure, and we cannot guarantee absolute security.
                        </p>
                    </section>

                    <Separator />

                    <section>
                        <h2 class="text-2xl font-bold mb-4">5. Your Rights</h2>
                        <p class="text-muted-foreground mb-4">
                            Depending on your location, you may have the following rights regarding your data:
                        </p>
                        <ul class="list-disc pl-6 space-y-2 text-muted-foreground mb-4">
                            <li>Access and receive a copy of your personal data</li>
                            <li>Rectify inaccurate or incomplete information</li>
                            <li>Request deletion of your personal data</li>
                            <li>Restrict or object to certain processing of your data</li>
                            <li>Data portability (receiving your data in a structured format)</li>
                            <li>Withdraw consent at any time where processing is based on consent</li>
                        </ul>
                        <p class="text-muted-foreground mb-4">
                            You can exercise these rights by contacting us at contact@sleeputility.com.
                        </p>
                    </section>

                    <Separator />

                    <section>
                        <h2 class="text-2xl font-bold mb-4">6. Cookies and Tracking Technologies</h2>
                        <p class="text-muted-foreground mb-4">
                            We use cookies and similar tracking technologies to collect information about your browsing activities and to remember your preferences. You can manage your cookie preferences through your browser settings.
                        </p>
                        <p class="text-muted-foreground mb-4">
                            We use essential cookies to ensure the proper functioning of the website and analytical cookies to understand how visitors interact with our website. We may also use marketing cookies to display personalized advertisements.
                        </p>
                    </section>

                    <Separator />

                    <section>
                        <h2 class="text-2xl font-bold mb-4">7. Third-Party Services</h2>
                        <p class="text-muted-foreground mb-4">
                            Our service may include links to third-party websites or services. We are not responsible for the privacy practices of these third parties. We encourage you to read the privacy policies of any third-party service you interact with.
                        </p>
                        <p class="text-muted-foreground mb-4">
                            We may use third-party service providers, such as Google Analytics, to monitor and analyze the use of our service.
                        </p>
                    </section>

                    <Separator />

                    <section>
                        <h2 class="text-2xl font-bold mb-4">8. Children's Privacy</h2>
                        <p class="text-muted-foreground mb-4">
                            Our service is not intended for children under the age of 13, and we do not knowingly collect personal information from children. If you are a parent or guardian and believe your child has provided us with personal information, please contact us.
                        </p>
                    </section>

                    <Separator />

                    <section>
                        <h2 class="text-2xl font-bold mb-4">9. Changes to This Privacy Policy</h2>
                        <p class="text-muted-foreground mb-4">
                            We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last updated" date.
                        </p>
                        <p class="text-muted-foreground mb-4">
                            We recommend that you review this Privacy Policy periodically for any changes.
                        </p>
                    </section>

                    <Separator />

                    <section>
                        <h2 class="text-2xl font-bold mb-4">10. Contact Us</h2>
                        <p class="text-muted-foreground mb-4">
                            If you have any questions about this Privacy Policy, please contact us at contact@sleeputility.com.
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
