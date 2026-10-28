import assert from 'node:assert/strict';
import test from 'node:test';
import { calculateSavingsSimulation } from '../../public/assets/js/savings-simulation.js';

test('Simpanan Siaga rejects deposits below Rp100,000 and invalid durations', () => {
  for (const amount of [0, 99999, -1, NaN, Infinity, 100000.5, 5000001]) {
    assert.equal(calculateSavingsSimulation(amount, 12), null);
  }
  for (const months of [0, -1, 121, NaN, Infinity, 12.5]) {
    assert.equal(calculateSavingsSimulation(100000, months), null);
  }
});

test('the first end-of-month deposit has not yet earned interest', () => {
  const result = calculateSavingsSimulation(100000, 1);
  assert.equal(result.finalBalance, 100000);
  assert.equal(result.totalInterest, 0);
  assert.equal(result.totalDeposited, 100000);
  assert.equal(result.annualRatePercent, 6);
});

test('monthly deposits earn compound interest at an effective annual rate of 6%', () => {
  const result = calculateSavingsSimulation(100000, 12);
  assert.ok(Math.abs(result.finalBalance - 1232652.834204) < 0.01);
  assert.equal(result.totalDeposited, 1200000);
  assert.ok(Math.abs(result.totalInterest - (result.finalBalance - 1200000)) < 0.01);
});

test('compound interest scales with the monthly deposit', () => {
  const minimum = calculateSavingsSimulation(100000, 24);
  const higher = calculateSavingsSimulation(500000, 24);
  assert.ok(Math.abs(higher.finalBalance - minimum.finalBalance * 5) < 0.01);
  assert.ok(Math.abs(minimum.finalBalance - 2539264.838460) < 0.01);
  assert.ok(calculateSavingsSimulation(5000000, 120));
});
