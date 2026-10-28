const loanPolicies = [
  {maximumPrincipal: 19999999, monthlyRatePercent: 2, minimumMonths: 12, maximumMonths: 36},
  {maximumPrincipal: 49999999, monthlyRatePercent: 1.6, minimumMonths: 12, maximumMonths: 36},
  {maximumPrincipal: 99999999, monthlyRatePercent: 1.5, minimumMonths: 12, maximumMonths: 60},
  {maximumPrincipal: Infinity, monthlyRatePercent: 1.4, minimumMonths: 12, maximumMonths: 60}
];

const businessLoanPolicies = [
  {minimumPrincipal: 20000000, maximumPrincipal: 49999999, monthlyRatePercent: 1.6, minimumMonths: 12, maximumMonths: 36},
  {minimumPrincipal: 50000000, maximumPrincipal: 99999999, monthlyRatePercent: 1.5, minimumMonths: 12, maximumMonths: 60},
  {minimumPrincipal: 100000000, maximumPrincipal: 200000000, monthlyRatePercent: 1.4, minimumMonths: 12, maximumMonths: 60}
];

export function getLoanPolicy(principal, loanType = 'standard') {
  if (!Number.isSafeInteger(principal) || principal < 1000000) {
    return null;
  }
  if (loanType === 'business') {
    return businessLoanPolicies.find(policy => principal >= policy.minimumPrincipal && principal <= policy.maximumPrincipal) ?? null;
  }
  return loanPolicies.find(policy => principal <= policy.maximumPrincipal);
}

export function calculateLoanSimulation(principal, months, loanType = 'standard') {
  const policy = getLoanPolicy(principal, loanType);
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
