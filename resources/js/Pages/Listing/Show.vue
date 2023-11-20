<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 flex items-center w-full">
            <div v-if="listing.images.length" class="grid grid-cols-2 gap-1">
                <img v-for="image in listing.images" alt="Listing Images" :key="image.id" :src="image.src"/>
            </div>
            <div v-else class="w-full text-center font-medium text-gray-500">
                No Images
            </div>
        </Box>
        <div class="md:col-span-5">
            <Box>
                <template #header>
                    Basic info
                </template>
                <Price :price="listing.price" class="text-2xl font-bold"/>
                <ListingSpace :listing="listing" class="text-lg"/>
                <ListingAddress :listing="listing" class="text-gray-500"/>
                <div class="text-gray-500">Made By {{props.listing.owner.name}}</div>
            </Box>
            <Box class="mt-2">
                <template #header>
                    Monthly Payment
                </template>
                <div>
                    <label class="label">Intereset rate ({{ interestRate }}%)</label>
                    <input v-model.number="interestRate" type="range" min="0.1" max="30" step="0.1" class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-200">

                    <label class="label">Duration ({{ duration }} Years)</label>
                    <input v-model.number="duration" type="range" min="3" max="35" step="1" class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-200">
                </div>

                <div class="text-gray-600 dark:text-gray-300 mt-2">
                    <div class="text-gray-400">Your monthly payment</div>
                    <Price :price="monthlyPayment" class="text-3xl"/>
                </div>
                <div class="mt-2">
                    <div class="flex justify-between text-sm text-gray-500">
                        <div>Principal Paid</div>
                        <Price :price="listing.price"/>
                    </div>
                    <div class="flex justify-between text-sm text-gray-500">
                        <div>Total Paid</div>
                        <Price :price="totalPaid"/>
                    </div>
                    <div class="flex justify-between text-sm text-gray-500">
                        <div>Interest Paid</div>
                        <Price :price="totalInterest"/>
                    </div>
                </div>
            </Box>

            <MakeOffer :listing-id="listing.id" :price="listing.price" @offer-updated="offer = $event" v-if="$page.props.login && !offerMade"/>

            <OfferMade :offer-made="props.offerMade" v-if="$page.props.login && offerMade"/>
        </div>
    </div>
</template>

<script setup>
    import ListingSpace from '@/Components/ListingSpace.vue';
    import ListingAddress from '@/Components/listingAddress.vue';
    import Price from '@/Components/Price.vue';
    import Box from '@/Components/UI/Box.vue';

    import {ref, computed} from 'vue';
    import { useMonthlyPayment } from '@/Composables/useMonthlyPayment';
    import MakeOffer from "@/Pages/Listing/Show/Components/MakeOffer.vue";
    import OfferMade from "@/Pages/Listing/Show/Components/OfferMade.vue";

    const interestRate = ref(2.5);
    const duration = ref(25);

    const props = defineProps({
        listing: Object,
        offerMade: Object
    })

    const offer = ref(props.listing.price);

    const usemonthlyPaymentresult = computed(() => useMonthlyPayment(offer.value, interestRate.value, duration.value))
    const monthlyPayment = computed(() => usemonthlyPaymentresult.value.monthlyPayment);
    const totalInterest = computed(() => usemonthlyPaymentresult.value.totalInterest);
    const totalPaid = computed(() => usemonthlyPaymentresult.value.totalPaid);
</script>
