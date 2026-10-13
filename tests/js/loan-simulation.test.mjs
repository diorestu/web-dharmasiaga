import assert from 'node:assert/strict';
import test from 'node:test';
import { getLoanPolicy, calculateLoanSimulation } from '../../public/assets/js/loan-simulation.js';

for (const [principal, monthlyRatePercent, maximumMonths] of [
  [1000000, 2, 36], [25000000, 2, 36],
  [25000001, 1.9, 36], [50000000, 1.9, 36],
  [50000001, 1.8, 60], [100000000, 1.8, 60],
  [100000001, 1.7, 36], [150000000, 1.7, 36],
]) {
  test(`policy for Rp ${principal}`, () => {
    const policy = getLoanPolicy(principal);
    assert.equal(policy.monthlyRatePercent, monthlyRatePercent);
    assert.equal(calculateLoanSimulation(principal, 12)?.monthlyRatePercent, monthlyRatePercent);
    assert.ok(calculateLoanSimulation(principal, maximumMonths));
    assert.equal(calculateLoanSimulation(principal, 11), null);
    assert.equal(calculateLoanSimulation(principal, maximumMonths + 1), null);
  });
}

test('invalid principal or duration does not produce a repayment', () => {
  for (const principal of [0, -1, 999999, NaN, Infinity, Number.MAX_SAFE_INTEGER + 1, 1000000.5]) {
    assert.equal(getLoanPolicy(principal), null);
    assert.equal(calculateLoanSimulation(principal, 12), null);
  }
  for (const duration of [0, -1, NaN, Infinity, 12.5]) {
    assert.equal(calculateLoanSimulation(10000000, duration), null);
  }
});

for (const [principal, months, expected] of [
  [10000000, 12, 945595.966229],
  [50000000, 36, 1930277.911184],
  [75000000, 60, 2054397.480061],
  [150000000, 36, 5605156.126847],
]) {
  test(`annuity payment for Rp ${principal} over ${months} months`, () => {
    const result = calculateLoanSimulation(principal, months);
    assert.ok(Math.abs(result.monthlyPayment - expected) < 0.01);
    assert.ok(Math.abs(result.totalPayment - expected * months) < 0.5);
    assert.ok(Math.abs(result.totalInterest - (expected * months - principal)) < 0.5);
  });
}
