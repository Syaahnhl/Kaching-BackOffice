(function (root, factory) {
    'use strict';
    const api = factory();
    if (typeof module === 'object' && module.exports) module.exports = api;
    else root.RmiSimulation = api;
})(typeof globalThis !== 'undefined' ? globalThis : this, function () {
    'use strict';
    function number(value, name, allowZero = false) {
        if (typeof value !== 'number' || !Number.isFinite(value) || (allowZero ? value < 0 : value <= 0)) {
            throw new Error(name + (allowZero ? ' harus berupa angka nol atau positif.' : ' harus berupa angka lebih dari nol.'));
        }
        return value;
    }
    function resolvePrice(basePrice, value, mode) {
        number(basePrice, 'Harga dasar');
        if (typeof value !== 'number' || !Number.isFinite(value)) throw new Error('Isi perubahan harga dengan angka yang valid.');
        let price;
        if (mode === 'percent') price = basePrice + basePrice * value / 100;
        else if (mode === 'price') price = value;
        else throw new Error('Mode perubahan harga tidak dikenal.');
        return number(price, 'Harga simulasi');
    }
    function simulate({ basePrice, newPrice, unit, recipes }) {
        number(basePrice, 'Harga dasar');
        number(newPrice, 'Harga simulasi');
        const units = { kg: { kg: 1, g: 0.001 }, liter: { liter: 1, ml: 0.001 } };
        if (!units[unit] || !Array.isArray(recipes)) throw new Error('Satuan atau resep tidak valid.');
        return recipes.map(recipe => {
            const factor = units[unit][recipe.quantityUnit];
            if (!factor) throw new Error('Satuan takaran tidak cocok dengan satuan harga.');
            number(recipe.quantity, 'Takaran', true);
            const complete = recipe.otherCost !== null && recipe.otherCost !== undefined;
            if (complete) number(recipe.otherCost, 'Biaya bahan lain', true);
            const hasSale = recipe.sellingPrice !== null && recipe.sellingPrice !== undefined;
            if (hasSale) number(recipe.sellingPrice, 'Harga jual');
            const beforeIngredient = recipe.quantity * factor * basePrice;
            const afterIngredient = recipe.quantity * factor * newPrice;
            const beforeCost = complete ? beforeIngredient + recipe.otherCost : null;
            const afterCost = complete ? afterIngredient + recipe.otherCost : null;
            const beforeMargin = complete && hasSale ? (recipe.sellingPrice - beforeCost) / recipe.sellingPrice * 100 : null;
            const afterMargin = complete && hasSale ? (recipe.sellingPrice - afterCost) / recipe.sellingPrice * 100 : null;
            return { ...recipe, complete, beforeIngredient, afterIngredient, beforeCost, afterCost,
                delta: afterIngredient - beforeIngredient, beforeMargin, afterMargin,
                marginDelta: beforeMargin === null ? null : afterMargin - beforeMargin };
        });
    }
    return { resolvePrice, simulate };
});
