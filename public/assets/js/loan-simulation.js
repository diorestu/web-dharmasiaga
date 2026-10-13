const loanPolicies = [
  {maximumPrincipal: 25000000, monthlyRatePercent: 2, minimumMonths: 12, maximumMonths: 36},
  {maximumPrincipal: 50000000, monthlyRatePercent: 1.9, minimumMonths: 12, maximumMonths: 36},
  {maximumPrincipal: 100000000, monthlyRatePercent: 1.8, minimumMonths: 12, maximumMonths: 60},
  {maximumPrincipal: Infinity, monthlyRatePercent: 1.7, minimumMonths: 12, maximumMonths: 36}
];

export function getLoanPolicy(principal) {
  if (!Number.isSafeInteger(principal) || principal < 1000000) {
    return null;
  }
  return loanPolicies.find(policy => principal <= policy.maximumPrincipal);
}

export function calculateLoanSimulation(principal, months) {
  const policy = getLoanPolicy(principal);
  if (!policy || !Number.isInteger(months) || months < policy.minimumMonths || months > policy.maximumMonths) {
    return null;
  }
  const monthlyRate = policy.monthlyRatePercent / 100;
  const monthlyPayment = principal * monthlyRate / (1 - Math.pow(1 + monthlyRate, -months));
  const totalPayment = monthlyPayment * months;
  return {
    monthlyPayment,
    totalPayment,
    totalInterest: totalPayment - principal,
    monthlyRatePercent: policy.monthlyRatePercent
  };
}
