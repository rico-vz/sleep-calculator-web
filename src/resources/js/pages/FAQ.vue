<script setup lang="ts">
import Footer from '@/components/Footer.vue';
import Header from '@/components/Header.vue';
import SeoHead from '@/components/SeoHead.vue';
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from '@/components/ui/accordion';
import { faqPageSchema } from '@/lib/seo';
import { SharedData } from '@/types';
import { Link } from '@inertiajs/vue3';
import { ExternalLink } from '@lucide/vue';

const props = defineProps<SharedData>();
const description = `Find answers to frequently asked questions about sleep cycles and using the ${props.name} calculator.`;
const faqItems = [
    {
        question: 'What is a sleep cycle?',
        answer: 'A sleep cycle is a progression through light sleep, deep sleep, and REM sleep. Each cycle typically lasts around 90 minutes, and most people go through four to six complete cycles per night.',
    },
    {
        question: 'How does SleepUtility calculate sleep times?',
        answer: 'SleepUtility uses 90-minute sleep cycles and a default 15-minute fall-asleep time. It calculates backwards from a wake-up time or forwards from a bedtime to suggest times between cycles.',
    },
    {
        question: 'Why do I feel groggy even after sleeping 8 hours?',
        answer: 'Waking in the middle of a sleep cycle, particularly during deep sleep, can contribute to sleep inertia. SleepUtility suggests times that align with the completion of cycles.',
    },
    {
        question: 'How much sleep do I really need?',
        answer: 'Sleep needs vary by age and individual. The page lists general guidelines of seven to nine hours for adults, eight to ten hours for teenagers, nine to twelve hours for children, and ten to fourteen hours for younger children.',
    },
    {
        question: 'Can I customize the fall-asleep time?',
        answer: 'Yes. Registered users can customize their fall-asleep time in Sleep Preferences to better reflect their personal sleep patterns.',
    },
    {
        question: 'Does SleepUtility account for different sleep patterns?',
        answer: 'SleepUtility is primarily designed around monophasic sleep patterns. It can still provide value for polyphasic sleep, but is optimized for a standard sleep schedule.',
    },
    {
        question: 'Why should I create an account?',
        answer: 'An account lets users customize their fall-asleep time, save preferences across devices, and use appearance settings that persist across sessions.',
    },
    {
        question: 'Where can I learn more about sleep science?',
        answer: 'The page links to the National Sleep Foundation, CDC sleep resources, and the National Institute of Neurological Disorders and Stroke, as well as the SleepUtility About page.',
    },
];
</script>

<template>
    <SeoHead title="FAQ" :description="description" :canonical="route('faq')" page-type="FAQPage" :schemas="[faqPageSchema(faqItems)]" />

    <div class="flex min-h-screen flex-col">
        <Header :appName="props.name" :auth="props.auth" />
        <main class="flex-1">
            <div class="container mx-auto max-w-4xl px-4 py-16">
                <div class="mb-12 text-center">
                    <h1 class="text-4xl font-bold tracking-tight">Frequently Asked Questions</h1>
                    <p class="text-muted-foreground mx-auto mt-4 max-w-2xl text-xl">
                        Common questions about sleep cycles and how to use {{ props.name }}
                    </p>
                </div>

                <Accordion type="single" collapsible class="w-full space-y-4">
                    <AccordionItem value="item-1" class="rounded-lg border px-6">
                        <AccordionTrigger class="text-left font-medium"> What is a sleep cycle? </AccordionTrigger>
                        <AccordionContent>
                            <p class="text-muted-foreground mb-2">
                                A sleep cycle is a progression through different stages of sleep that your body experiences throughout the night. Each
                                cycle typically lasts around 90 minutes and consists of:
                            </p>
                            <ul class="text-muted-foreground mb-4 list-disc space-y-2 pl-6">
                                <li>Light Sleep (Stage 1): The transition between wakefulness and sleep</li>
                                <li>Light Sleep (Stage 2): When body temperature drops and heart rate slows down</li>
                                <li>Deep Sleep (Stage 3): The most restorative sleep phase</li>
                                <li>REM Sleep: When most dreaming occurs, crucial for cognitive function and memory</li>
                            </ul>
                            <p class="text-muted-foreground">Most people go through 4-6 complete sleep cycles per night.</p>
                        </AccordionContent>
                    </AccordionItem>

                    <AccordionItem value="item-2" class="rounded-lg border px-6">
                        <AccordionTrigger class="text-left font-medium"> How does {{ props.name }} calculate sleep times? </AccordionTrigger>
                        <AccordionContent>
                            <p class="text-muted-foreground mb-4">
                                {{ props.name }} uses the 90-minute sleep cycle as a base for calculations, along with:
                            </p>
                            <ul class="text-muted-foreground mb-4 list-disc space-y-2 pl-6">
                                <li>The average time it takes to fall asleep (15 minutes by default, customizable in account settings)</li>
                                <li>Complete sleep cycles of 90 minutes each</li>
                                <li>Optimal timing to wake up between cycles rather than during deep sleep</li>
                            </ul>
                            <p class="text-muted-foreground">
                                When you input a wake-up time, we calculate backward in 90-minute increments to determine ideal bedtimes. When you
                                input a bedtime, we calculate forward to suggest optimal wake-up times.
                            </p>
                        </AccordionContent>
                    </AccordionItem>

                    <AccordionItem value="item-3" class="rounded-lg border px-6">
                        <AccordionTrigger class="text-left font-medium"> Why do I feel groggy even after sleeping 8 hours? </AccordionTrigger>
                        <AccordionContent>
                            <p class="text-muted-foreground mb-4">
                                Feeling groggy after a full night's sleep is often caused by waking up in the middle of a sleep cycle, particularly
                                during deep sleep. This results in "sleep inertia" - that disoriented, groggy feeling.
                            </p>
                            <p class="text-muted-foreground mb-4">
                                Even if you get the recommended 7-9 hours, if your alarm disrupts a deep sleep phase, you'll likely feel tired.
                                {{ props.name }} aims to solve this by suggesting times that align with the completion of your sleep cycles, when
                                you're naturally in lighter sleep.
                            </p>
                            <p class="text-muted-foreground">
                                Other factors like sleep quality, environment, and personal health can also affect how refreshed you feel upon waking.
                            </p>
                        </AccordionContent>
                    </AccordionItem>

                    <AccordionItem value="item-4" class="rounded-lg border px-6">
                        <AccordionTrigger class="text-left font-medium"> How much sleep do I really need? </AccordionTrigger>
                        <AccordionContent>
                            <p class="text-muted-foreground mb-4">Sleep needs vary by age and individual, but general guidelines include:</p>
                            <ul class="text-muted-foreground mb-4 list-disc space-y-2 pl-6">
                                <li>Adults: 7-9 hours (about 5-6 complete sleep cycles)</li>
                                <li>Teenagers: 8-10 hours</li>
                                <li>Children (6-12): 9-12 hours</li>
                                <li>Infants and younger children: 10-14 hours</li>
                            </ul>
                            <p class="text-muted-foreground">
                                Individual needs may vary based on health, activity levels, and genetics. Quality of sleep is just as important as
                                quantity.
                            </p>
                        </AccordionContent>
                    </AccordionItem>

                    <AccordionItem value="item-5" class="rounded-lg border px-6">
                        <AccordionTrigger class="text-left font-medium"> Can I customize the fall-asleep time? </AccordionTrigger>
                        <AccordionContent>
                            <p class="text-muted-foreground mb-4">
                                Yes! {{ props.name }} allows registered users to customize the fall-asleep time in their profile settings. This makes
                                the calculations more accurate for your personal sleep patterns.
                            </p>
                            <p class="text-muted-foreground">To change this setting, go to Settings → Sleep Preferences after logging in.</p>
                        </AccordionContent>
                    </AccordionItem>

                    <AccordionItem value="item-6" class="rounded-lg border px-6">
                        <AccordionTrigger class="text-left font-medium">
                            Does {{ props.name }} account for different sleep patterns?
                        </AccordionTrigger>
                        <AccordionContent>
                            <p class="text-muted-foreground mb-4">
                                {{ props.name }} is primarily designed around monophasic sleep patterns (one sleep period per day). The 90-minute
                                cycle calculation works best for this traditional sleep schedule.
                            </p>
                            <p class="text-muted-foreground">
                                While the calculator can still provide value for those with polyphasic sleep (multiple sleep periods throughout the
                                day), it's optimized for standard sleep patterns.
                            </p>
                        </AccordionContent>
                    </AccordionItem>

                    <AccordionItem value="item-7" class="rounded-lg border px-6">
                        <AccordionTrigger class="text-left font-medium"> Why should I create an account? </AccordionTrigger>
                        <AccordionContent>
                            <p class="text-muted-foreground mb-4">Creating an account provides several benefits:</p>
                            <ul class="text-muted-foreground mb-4 list-disc space-y-2 pl-6">
                                <li>Customize your fall-asleep time for more accurate calculations</li>
                                <li>Save your preference settings across all your devices</li>
                                <li>Access to upcoming features like sleep tracking and personalized recommendations</li>
                                <li>Appearance settings (dark/light mode) that persist across sessions</li>
                            </ul>
                            <p class="text-muted-foreground">Registration is quick and free. You can sign up using your email or Google account.</p>
                        </AccordionContent>
                    </AccordionItem>

                    <AccordionItem value="item-8" class="rounded-lg border px-6">
                        <AccordionTrigger class="text-left font-medium"> Where can I learn more about sleep science? </AccordionTrigger>
                        <AccordionContent>
                            <p class="text-muted-foreground mb-4">We recommend these reputable resources for learning more about sleep health:</p>
                            <ul class="text-muted-foreground mb-4 list-disc space-y-2 pl-6">
                                <li>
                                    <a
                                        href="https://www.sleepfoundation.org/"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="text-primary inline-flex items-center hover:underline"
                                    >
                                        National Sleep Foundation
                                        <ExternalLink class="ml-1 h-3 w-3" />
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="https://www.cdc.gov/sleep/"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="text-primary inline-flex items-center hover:underline"
                                    >
                                        CDC - Sleep and Sleep Disorders
                                        <ExternalLink class="ml-1 h-3 w-3" />
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="https://www.ninds.nih.gov/health-information/public-education/brain-basics/brain-basics-understanding-sleep"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="text-primary inline-flex items-center hover:underline"
                                    >
                                        National Institute of Neurological Disorders and Stroke - Sleep
                                        <ExternalLink class="ml-1 h-3 w-3" />
                                    </a>
                                </li>
                            </ul>
                            <p class="text-muted-foreground">
                                You can also check our
                                <Link href="/about" class="text-primary hover:underline">About page</Link> for more information on sleep cycles and
                                the science behind our calculator.
                            </p>
                        </AccordionContent>
                    </AccordionItem>
                </Accordion>
            </div>
        </main>
        <Footer :appName="props.name" />
    </div>
</template>
