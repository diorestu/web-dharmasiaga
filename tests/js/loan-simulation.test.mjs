import assert from 'node:assert/strict';
import test from 'node:test';
import { getLoanPolicy, calculateLoanSimulation } from '../../public/assets/js/loan-simulation.js';

// Business loan policies (aturan pinjaman usaha / bunga rendah)
for (const [principal, rate, maximumMonths] of [
  [20000000, 1.6, 36],
  [49999999, 1.6, 36],
  [50000000, 1.5, 60],
  [99999999, 1.5, 60],
  [100000000, 1.4, 60],
  [200000000, 1.4, 60],
]) {
  test(`business loan policy for Rp ${principal}`, () => {
    const policy = getLoanPolicy(principal, 'business');
    assert.ok(policy, `business policy should exist for Rp ${principal}`);
    assert.equal(policy.monthlyRatePercent, rate);
    assert.equal(policy.maximumMonths, maximumMonths);
    const result = calculateLoanSimulation(principal, 12, 'business');
    assert.equal(result.monthlyRatePercent, rate);
    assert.ok(result.totalPayment > principal);
    assert.equal(calculateLoanSimulation(principal, maximumMonths + 1, 'business'), null);
    assert.equal(calculateLoanSimulation(principal, 11, 'business'), null);
  });
}

test('business loan rejects amounts below Rp 20.000.000 and above Rp 200.000.000', () => {
  for (const principal of [0, -1, 999999, 1000000, 5000000, 10000000, 19999999, NaN, Infinity, Number.MAX_SAFE_INTEGER + 1, 200000001]) {
    assert.equal(getLoanPolicy(principal, 'business'), null);
    assert.equal(calculateLoanSimulation(principal, 12, 'business'), null);
  }
});

// Standard loan policies (aturan awal pinjaman anggota)
for (const [principal, monthlyRatePercent, maximumMonths] of [
  [1000000, 2, 36],
  [10000000, 2, 36],
  [25000000, 2, 36],
  [25000001, 1.9, 36],
  [50000000, 1.9, 36],
  [50000001, 1.8, 60],
  [100000000, 1.8, 60],
  [100000001, 1.7, 36],
  [150000000, 1.7, 36],
]) {
  test(`standard loan policy for Rp ${principal}`, () => {
    const policy = getLoanPolicy(principal, 'standard');
    assert.ok(policy, `standard policy should exist for Rp ${principal}`);
    assert.equal(policy.monthlyRatePercent, monthlyRatePercent);
    assert.equal(policy.maximumMonths, maximumMonths);
    const result = calculateLoanSimulation(principal, 12, 'standard');
    assert.equal(result.monthlyRatePercent, monthlyRatePercent);
    assert.ok(result.totalPayment > principal);
    assert.equal(calculateLoanSimulation(principal, maximumMonths + 1, 'standard'), null);
    assert.equal(calculateLoanSimulation(principal, 11, 'standard'), null);
  });
}

test('standard loan rejects amounts below Rp 1.000.000', () => {
  for (const principal of [0, -1, 999999, NaN, Infinity, Number.MAX_SAFE_INTEGER + 1, 1000000.5]) {
    assert.equal(getLoanPolicy(principal, 'standard'), null);
    assert.equal(calculateLoanSimulation(principal, 12, 'standard'), null);
  }
});

test('invalid duration does not produce a repayment', () => {
  for (const duration of [0, -1, NaN, Infinity, 12.5, 61]) {
    assert.equal(calculateLoanSimulation(10000000, duration, 'standard'), null);
    assert.equal(calculateLoanSimulation(20000000, duration, 'business'), null);
  }
});

for (const [principal, months, expected] of [
  [10000000, 12, 945595.966229],
  [50000000, 36, 1930277.911184],
  [75000000, 60, 2054397.480061],
  [150000000, 36, 5605156.126847],
]) {
  test(`standard loan annuity payment for Rp ${principal} over ${months} months`, () => {
    const result = calculateLoanSimulation(principal, months, 'standard');
    assert.ok(result, `expected result for ${principal}`);
    assert.ok(Math.abs(result.monthlyPayment - expected) < 0.01);
    assert.ok(Math.abs(result.totalPayment - expected * months) < 0.5);
    assert.ok(Math.abs(result.totalInterest - (expected * months - principal)) < 0.5);
  });
}

const brochureTableRows = [
  {principal: 20000000, payments: {12: 1845041, 24: 1010117, 36: 735144}},
  {principal: 25000000, payments: {12: 2306301, 24: 1262646, 36: 918930}},
  {principal: 30000000, payments: {12: 2767562, 24: 1515175, 36: 1102717}},
  {principal: 35000000, payments: {12: 3228822, 24: 1767704, 36: 1286503}},
  {principal: 40000000, payments: {12: 3690082, 24: 2020234, 36: 1470289}},
  {principal: 45000000, payments: {12: 4151343, 24: 2272763, 36: 1654075}},
  {principal: 50000000, payments: {12: 4584000, 24: 2496205, 36: 1807620, 48: 1468750, 60: 1269671}},
  {principal: 55000000, payments: {12: 5042400, 24: 2745826, 36: 1988382, 48: 1615625, 60: 1396639}},
  {principal: 60000000, payments: {12: 5500800, 24: 2995446, 36: 2169144, 48: 1762500, 60: 1523606}},
  {principal: 65000000, payments: {12: 5959200, 24: 3245067, 36: 2349906, 48: 1909375, 60: 1650573}},
  {principal: 70000000, payments: {12: 6417600, 24: 3494687, 36: 2530668, 48: 2056250, 60: 1777540}},
  {principal: 75000000, payments: {12: 6875999, 24: 3744308, 36: 2711430, 48: 2203125, 60: 1904507}},
  {principal: 80000000, payments: {12: 7334399, 24: 3993928, 36: 2892192, 48: 2350000, 60: 2031474}},
  {principal: 85000000, payments: {12: 7792799, 24: 4243549, 36: 3072954, 48: 2496875, 60: 2158441}},
  {principal: 90000000, payments: {12: 8251199, 24: 4493169, 36: 3253716, 48: 2643750, 60: 2285408}},
  {principal: 95000000, payments: {12: 8709599, 24: 4742790, 36: 3434478, 48: 2790625, 60: 2412376}},
  {principal: 100000000, payments: {12: 9110987, 24: 4934622, 36: 3555327, 48: 2875167, 60: 2474516}},
];

for (const row of brochureTableRows) {
  test(`brochure table calculation matches for business loan Rp ${row.principal}`, () => {
    for (const [monthsStr, expectedPayment] of Object.entries(row.payments)) {
      const months = Number(monthsStr);
      const businessSimulation = calculateLoanSimulation(row.principal, months, 'business');
      assert.ok(businessSimulation, `expected business simulation for Rp ${row.principal} over ${months} months`);
      assert.equal(Math.round(businessSimulation.monthlyPayment), expectedPayment);
    }
  });
}
