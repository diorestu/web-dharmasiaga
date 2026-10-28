import assert from 'node:assert/strict';
import test from 'node:test';
import { calculateSavingsSimulation } from '../../public/assets/js/savings-simulation.js';

test('Simpanan Siaga rejects deposits below Rp100,000 and invalid durations', () => {
  for (const amount of [0, 99999, -1, NaN, Infinity, 100000.5, 5000001]) {
    assert.equal(calculateSavingsSimulation(amount, 12), null);
  }
  for (const months of [0, -1, 1, 2, 3, 6, 9, 11, 121, NaN, Infinity, 12.5]) {
    assert.equal(calculateSavingsSimulation(100000, months), null);
  }
});

test('the first end-of-month deposit has not yet earned interest (tested with minMonths=1)', () => {
  const result = calculateSavingsSimulation(100000, 1, 1);
  assert.equal(result.finalBalance, 100000);
  assert.equal(result.totalInterest, 0);
  assert.equal(result.totalDeposited, 100000);
  assert.equal(result.annualRatePercent, 6);
});

for (const [months, interest, balance] of [
  [1, 0, 1000000], [2, 5000, 2005000], [3, 10025, 3015025],
  [4, 15075, 4030100], [5, 20150, 5050250], [6, 25251, 6075501],
  [7, 30377, 7105878], [8, 35529, 8141407], [9, 40707, 9182114],
  [10, 45910, 10228024], [11, 51140, 11279164], [12, 56395, 12335559],
]) {
  test(`matches month ${months} in the supplied Simpanan Siaga table`, () => {
    const result = calculateSavingsSimulation(1000000, months, 1);
    const previousBalance = months === 1 ? 0 : calculateSavingsSimulation(1000000, months - 1, 1).finalBalance;
    assert.equal(result.finalBalance, balance);
    assert.equal(result.finalBalance - previousBalance - 1000000, interest);
    assert.equal(result.totalDeposited, 1000000 * months);
    assert.equal(result.totalInterest, balance - result.totalDeposited);
  });
}

test('monthly interest is floored to whole rupiah before adding the next deposit', () => {
  assert.equal(calculateSavingsSimulation(100199, 2, 1).finalBalance, 200898);
  assert.equal(calculateSavingsSimulation(100200, 2, 1).finalBalance, 200901);
});

test('minimum and maximum supported deposits produce whole-rupiah balances', () => {
  for (const amount of [100000, 5000000]) {
    const result = calculateSavingsSimulation(amount, 120);
    assert.ok(Number.isSafeInteger(result.finalBalance));
    assert.ok(Number.isSafeInteger(result.totalInterest));
    assert.ok(result.finalBalance > result.totalDeposited);
  }
});
