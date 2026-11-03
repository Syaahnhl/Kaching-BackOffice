const {test}=require('node:test');
const assert=require('node:assert/strict');
const fs=require('node:fs');
const path=require('node:path');
const modulePath=path.resolve(__dirname,'../../resources/rmi/rmi-simulator.js');
 const unavailable=()=>assert.fail('The simulation engine has not been implemented');
 const {simulate,resolvePrice}=fs.existsSync(modulePath)?require(modulePath):{simulate:unavailable,resolvePrice:unavailable};
 const recipes=[
  {name:'Pancake Original',quantity:100,quantityUnit:'g',otherCost:4800,sellingPrice:20000},
  {name:'Croissant Butter',quantity:50,quantityUnit:'g',otherCost:4970,sellingPrice:22000},
  {name:'Mie Ayam',quantity:80,quantityUnit:'g',otherCost:5040,sellingPrice:18000},
  {name:'Roti Isi',quantity:80,quantityUnit:'g',otherCost:null,sellingPrice:15000},
 ];
 test('manual percentage and direct price resolve consistently',()=>{
  assert.equal(resolvePrice(12000,10,'percent'),13200);
  assert.equal(resolvePrice(12000,13200,'price'),13200);
  assert.equal(resolvePrice(12000,-10,'percent'),10800);
 });
 test('flour scenario matches independently specified per-portion costs',()=>{
  const rows=simulate({basePrice:12000,newPrice:13200,unit:'kg',recipes});
  assert.deepEqual(rows.map(r=>r.afterCost),[6120,5630,6096,null]);
  assert.deepEqual(rows.map(r=>r.delta),[120,60,96,96]);
  assert.ok(Math.abs(rows[0].beforeMargin-70)<1e-9);
  assert.ok(Math.abs(rows[0].afterMargin-69.4)<1e-9);
  assert.ok(Math.abs(rows[0].marginDelta-(-0.6))<1e-9);
 });
 test('partial recipe preserves ingredient estimate but never fabricates full cost or margin',()=>{
  const r=simulate({basePrice:12000,newPrice:13200,unit:'kg',recipes:[recipes[3]]})[0];
  assert.equal(r.beforeIngredient,960);assert.equal(r.afterIngredient,1056);
  assert.equal(r.beforeCost,null);assert.equal(r.afterCost,null);assert.equal(r.afterMargin,null);assert.equal(r.complete,false);
 });
 test('missing selling price retains recipe cost but suppresses margin',()=>{
  const r=simulate({basePrice:12000,newPrice:13200,unit:'kg',recipes:[{...recipes[0],sellingPrice:null}]})[0];
  assert.equal(r.afterCost,6120);assert.equal(r.afterMargin,null);assert.equal(r.marginDelta,null);
 });
 test('zero other ingredient cost is valid and differs from missing cost',()=>{
  const r=simulate({basePrice:12000,newPrice:13200,unit:'kg',recipes:[{...recipes[0],otherCost:0}]})[0];
  assert.equal(r.afterCost,1320);assert.equal(r.complete,true);
 });
 test('liquid conversion uses 1000 millilitres per litre',()=>{
  const r=simulate({basePrice:16000,newPrice:17600,unit:'liter',recipes:[{name:'Contoh',quantity:20,quantityUnit:'ml',otherCost:5000,sellingPrice:15000}]})[0];
  assert.equal(r.beforeIngredient,320);assert.equal(r.afterIngredient,352);assert.equal(r.delta,32);
 });
 test('price decrease produces negative ingredient delta and positive margin delta',()=>{
  const r=simulate({basePrice:12000,newPrice:10800,unit:'kg',recipes:[recipes[0]]})[0];
  assert.equal(r.delta,-120);assert.ok(r.marginDelta>0);
 });
 test('invalid price inputs are rejected instead of becoming zero or NaN',()=>{
  for(const bad of [0,-1,NaN,Infinity,'',null,'12000']) assert.throws(()=>resolvePrice(bad,10,'percent'));
  for(const bad of [-100,-101,NaN,Infinity,'',null]) assert.throws(()=>resolvePrice(12000,bad,'percent'));
  assert.throws(()=>resolvePrice(12000,10,'unknown'));
  assert.throws(()=>simulate({basePrice:12000,newPrice:NaN,unit:'kg',recipes}));
 });
 test('incompatible quantities and negative/unknown recipe values are rejected',()=>{
  for(const changes of [{quantityUnit:'ml'},{quantity:-1},{otherCost:-1},{sellingPrice:0}])
   assert.throws(()=>simulate({basePrice:12000,newPrice:13200,unit:'kg',recipes:[{...recipes[0],...changes}]}));
 });
 test('missing mapped recipes yields an empty result',()=>assert.deepEqual(simulate({basePrice:12000,newPrice:13200,unit:'kg',recipes:[]}),[]));
