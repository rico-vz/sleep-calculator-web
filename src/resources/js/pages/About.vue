<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { SharedData } from '@/types';
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
import { Button } from "@/components/ui/button";
import { Separator } from "@/components/ui/separator";

const props = defineProps<SharedData>();
</script>

<template>

    <Head title="About" />
    <div class="flex min-h-screen flex-col">
        <Header :appName="props.name" :auth="props.auth" />
        <main class="flex-1">
            <div class="container max-w-4xl mx-auto py-16 px-4">
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold  tracking-tight">
                        About <span class="sleep-text-gradient">{{ props.name }}</span>
                    </h1>
                    <p class="text-xl text-muted-foreground mt-4 max-w-2xl mx-auto">
                        Helping you wake up refreshed and energized by optimizing your sleep cycles.
                    </p>
                </div>

                <div class="space-y-10">
                    <section>
                        <h2 class="text-2xl font-bold  mb-4">Our Story</h2>
                        <p class="text-muted-foreground mb-4">
                            {{ props.name }} was created as a passion project after I read more about how waking up at
                            the
                            right time in your sleep cycle can make a huge difference in how you feel in the morning.
                        </p>
                        <p class="text-muted-foreground">
                            After creating a simple CLI tool to calculate the best time to wake up for myself, I
                            realized that
                            this helped me feel a lot more energized in the morning. I decided to turn this into a web
                            app so that
                            it is easier to use (from your phone for example) and to share it with others.
                        </p>
                    </section>

                    <Separator />

                    <section>
                        <h2 class="text-2xl font-bold  mb-4">The Science Behind Sleep Cycles</h2>
                        <p class="text-muted-foreground mb-4">
                            Throughout the night, your body goes through multiple sleep
                            cycles, each lasting approximately 90 minutes. Each cycle consists of different stages:
                        </p>

                        <ul class="list-disc pl-6 space-y-2 text-muted-foreground mb-4">
                            <li>
                                <span class="font-medium text-foreground">Light Sleep (Stage 1):</span> The transition
                                between wakefulness and sleep<sup><a href="#ref1">[1]</a></sup>.
                            </li>
                            <li>
                                <span class="font-medium text-foreground">Light Sleep (Stage 2):</span> Body temperature
                                drops and heart rate slows down. Around 50% of your sleep time is spent in this
                                stage<sup><a href="#ref2">[2]</a></sup>.
                            </li>
                            <li>
                                <span class="font-medium text-foreground">Deep Sleep (Stage 3):</span> The most
                                restorative sleep phase, essential for physical recovery<sup><a
                                        href="#ref2">[2]</a></sup>.
                            </li>
                            <li>
                                <span class="font-medium text-foreground">REM Sleep:</span> When most dreaming occurs,
                                crucial for cognitive function and memory consolidation<sup><a
                                        href="#ref1">[1]</a></sup>.
                            </li>
                        </ul>

                        <p class="text-muted-foreground">
                            Waking up during <span class="font-medium text-foreground">Stage 3 (deep sleep)</span>
                            causes the strongest sleep inertia<sup><a href="#ref3">[3]</a></sup>. Sleep inertia is that
                            groggy, disoriented feeling.
                            {{ props.name }} helps you wake up between cycles when you're in lighter sleep stages,
                            making it easier to start your day feeling refreshed.
                        </p>
                    </section>

                    <Separator />

                    <section>
                        <h2 class="text-2xl font-bold  mb-4">Our Approach</h2>
                        <p class="text-muted-foreground mb-4">
                            {{ props.name }}'s calculator uses proven sleep science to help you plan your sleep
                            schedule. We
                            factor in:
                        </p>

                        <ul class="list-disc pl-6 space-y-2 text-muted-foreground mb-4">
                            <li>The average time it takes to fall asleep (10 - 20 minutes)<sup><a
                                        href="#ref3">[4]</a></sup></li>
                            <li>Complete sleep cycles (approximately 90 minutes each)<sup><a href="#ref1">[1]</a></sup>
                            </li>
                            <li>Optimal number of cycles for restorative sleep (5-6 cycles)</li>
                        </ul>

                        <p class="text-muted-foreground">
                            Our recommendations prioritize waking up at the end of a sleep cycle, rather than in the
                            middle of one. This approach is backed by sleep research<sup><a href="#ref3">[3]</a></sup>
                            and helps users minimize morning
                            grogginess and maximize natural energy.
                        </p>
                    </section>

                    <Separator />

                    <section class="text-center">
                        <h2 class="text-2xl font-bold  mb-4">Try {{ props.name }} Today</h2>
                        <p class="text-muted-foreground mb-6 max-w-2xl mx-auto">
                            Experience better mornings and more energized days by optimizing your sleep cycles with our
                            calculator.
                        </p>
                        <Link href="/">
                        <Button size="lg" variant="default">
                            Try Sleep Calculator
                        </Button>
                        </Link>
                    </section>

                    <Separator />
                    <section>
                        <h2 class="text-2xl font-bold mb-4">References</h2>
                        <ol class="list-decimal pl-6 space-y-2 text-muted-foreground mb-4">
                            <li id="ref1">
                                <a href="https://www.ncbi.nlm.nih.gov/books/NBK19956/" target="_blank"
                                    rel="noopener noreferrer" class="text-primary hover:underline">Cite this Page
                                    Institute of Medicine (US) Committee on Sleep Medicine and Research; Colten HR,
                                    Altevogt BM, editors. Sleep Disorders and Sleep Deprivation: An Unmet Public Health
                                    Problem. Washington (DC): National Academies Press (US); 2006. 2, Sleep
                                    Physiology.</a>
                            </li>
                            <li id="ref2">
                                <a href="https://www.sleepfoundation.org/stages-of-sleep" target="_blank"
                                    rel="noopener noreferrer" class="text-primary hover:underline">Suni, Eric. “Stages
                                    of Sleep: What Happens in a Sleep Cycle.” Sleep Foundation. December 8, 2023.</a>
                            </li>
                            <li id="ref3">
                                <a href="https://pmc.ncbi.nlm.nih.gov/articles/PMC6710480/" target="_blank"
                                    rel="noopener noreferrer" class="text-primary hover:underline">Hilditch CJ, McHill
                                    AW. Sleep inertia: current insights. Nat Sci Sleep. 2019 Aug 22;11:155-165.</a>
                            </li>
                            <li id="ref4">
                                <a href="https://www.healthline.com/health/healthy-sleep/how-long-does-it-take-to-fall-asleep"
                                    target="_blank" rel="noopener noreferrer" class="text-primary hover:underline">James
                                    Roland. “How Long Should It Take You to Fall Asleep?” Healthline. Last modified
                                    February 10, 2023.</a>
                            </li>
                        </ol>
                    </section>
                </div>
            </div>
        </main>
        <Footer />
    </div>
</template>
