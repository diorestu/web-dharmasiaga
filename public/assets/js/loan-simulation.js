const loanPolicies = [
  {maximumPrincipal: 25000000, monthlyRatePercent: 2, minimumMonths: 12, maximumMonths: 36},
  {maximumPrincipal: 50000000, monthlyRatePercent: 1.9, minimumMonths: 12, maximumMonths: 36},
  {maximumPrincipal: 100000000, monthlyRatePercent: 1.8, minimumMonths: 12, maximumMonths: 60},
  {maximumPrincipal: Infinity, monthlyRatePercent: 1.7, minimumMonths: 12, maximumMonths: 36}
];

const businessLoanPolicies = [
  {minimumPrincipal: 20000000, maximumPrincipal: 49999999, monthlyRatePercent: 1.6, minimumMonths: 12, maximumMonths: 36},
  {minimumPrincipal: 50000000, maximumPrincipal: 99999999, monthlyRatePercent: 1.5, minimumMonths: 12, maximumMonths: 60},
  {minimumPrincipal: 100000000, maximumPrincipal: 200000000, monthlyRatePercent: 1.4, minimumMonths: 12, maximumMonths: 60}
];

export function getLoanPolicy(principal, loanType = 'standard') {
  if (!Number.isSafeInteger(principal)) {
    return null;
  }
  if (loanType === 'business') {
    if (principal < 20000000 || principal > 200000000) {
      return null;
    }
    return businessLoanPolicies.find(policy => principal >= policy.minimumPrincipal && principal <= policy.maximumPrincipal) ?? null;
  }
  if (principal < 1000000) {
    return null;
  }
  return loanPolicies.find(policy => principal <= policy.maximumPrincipal) ?? null;
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
