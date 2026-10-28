export function calculateSavingsSimulation(monthlyDeposit, months) {
  if (!Number.isSafeInteger(monthlyDeposit) || monthlyDeposit < 100000 || monthlyDeposit > 5000000 || !Number.isInteger(months) || months < 1 || months > 120) {
    return null;
  }

  const annualRatePercent = 6;
  const monthlyRate = Math.pow(1 + annualRatePercent / 100, 1 / 12) - 1;
  let finalBalance = 0;
  for (let month = 0; month < months; month++) {
    finalBalance = finalBalance * (1 + monthlyRate) + monthlyDeposit;
  }
  const totalDeposited = monthlyDeposit * months;

  return {
    finalBalance,
    totalDeposited,
    totalInterest: finalBalance - totalDeposited,
    annualRatePercent
  };
}
