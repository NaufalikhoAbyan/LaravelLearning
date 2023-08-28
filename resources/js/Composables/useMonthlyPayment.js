import {computed} from 'vue';

export const useMonthlyPayment = (total, interestRate, duration) =>{
    const principle = total;
    const monthlyInterest = interestRate / 100 / 12;
    const numberOfPaymentMonths = duration * 12;

    const monthlyPayment = principle * monthlyInterest * (Math.pow(1 + monthlyInterest, numberOfPaymentMonths)) / (Math.pow(1 + monthlyInterest, numberOfPaymentMonths) - 1);
    const totalPaid = duration * 12 * monthlyPayment;
    const totalInterest = totalPaid-total
    return {monthlyPayment, totalPaid, totalInterest}
}