export function calculateSavingsSimulation(monthlyDeposit, months) {
  if (!Number.isSafeInteger(monthlyDeposit) || monthlyDeposit < 100000 || monthlyDeposit > 5000000 || !Number.isInteger(months) || months < 1 || months > 120) {
    return null;
  }

  const annualRatePercent = 6;
  let finalBalance = 0;
  for (let month = 0; month < months; month++) {
    const monthlyInterest = Math.floor(finalBalance * annualRatePercent / 1200);
    finalBalance += monthlyInterest + monthlyDeposit;
  }
  const totalDeposited = monthlyDeposit * months;

  return {
    finalBalance,
    totalDeposited,
    totalInterest: finalBalance - totalDeposited,
    annualRatePercent
  };
}
