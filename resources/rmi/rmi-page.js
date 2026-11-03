(function () {
    'use strict';
    const app = document.getElementById('rmi-app');
    if (!app || !window.RmiSimulation) return;
    const $ = id => document.getElementById(id);
    const escape = value => String(value).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
    const decimal = new Intl.NumberFormat('id-ID', {maximumFractionDigits: 2});
    const quantity = new Intl.NumberFormat('id-ID', {maximumFractionDigits: 6});
    const integer = new Intl.NumberFormat('id-ID', {maximumFractionDigits: 0});
    const money = value => (value < 0 ? '−' : '') + 'Rp' + integer.format(Math.abs(value));
    const signedMoney = value => (value > 0 ? '+' : '') + money(value);
    const percent = value => new Intl.NumberFormat('id-ID', {minimumFractionDigits: 2, maximumFractionDigits: 2}).format(value) + '%';
    const icon = name => '<svg aria-hidden="true"><use href="#rmi-' + name + '"/></svg>';
    const imageBase = new URL('./images/', document.currentScript.src).href;
    // Synthetic fixtures only. No current item costs or production recipes are read here.
    const ingredients = {
        flour: {name:'Tepung terigu',unit:'kg',base:12000,recipes:[
            {name:'Pancake Original',quantity:100,quantityUnit:'g',otherCost:4800,sellingPrice:20000},
            {name:'Croissant Butter',quantity:50,quantityUnit:'g',otherCost:4970,sellingPrice:22000},
            {name:'Mie Ayam',quantity:80,quantityUnit:'g',otherCost:5040,sellingPrice:18000},
            {name:'Roti Isi',quantity:80,quantityUnit:'g',otherCost:null,sellingPrice:15000}]},
        chili: {name:'Cabai rawit merah',unit:'kg',base:55000,recipes:[
            {name:'Ayam Geprek',quantity:20,quantityUnit:'g',otherCost:7900,sellingPrice:22000},
            {name:'Nasi Goreng Pedas',quantity:15,quantityUnit:'g',otherCost:6175,sellingPrice:20000}]},
        oil: {name:'Minyak goreng',unit:'liter',base:16000,recipes:[
            {name:'French Fries',quantity:20,quantityUnit:'ml',otherCost:6620,sellingPrice:19000},
            {name:'Mix Platter',quantity:30,quantityUnit:'ml',otherCost:7120,sellingPrice:30000}]},
        unmapped: {name:'Bahan lain',unit:'kg',base:12000,recipes:[]}
    };
    // Unique archived articles from the user's saved page. URLs are source links, not a live feed.
    const news = [
        {category:'flour',label:'Tepung & gandum',ingredient:'flour',image:'rmi-wheat.jpg',source:'Bataviapos · melalui Google News',title:'Ujian Kedaulatan Pangan RI: Antara Harga Beras, Impor Gandum, dan Beban Konsumen',description:'Konteks pasokan dan impor gandum dapat menjadi alasan untuk memeriksa kembali harga tepung dari supplier.',context:'Uji asumsi perubahan harga tepung terhadap resep. Berita ini tidak memastikan harga beli di outlet Anda berubah.',url:'https://news.google.com/rss/articles/CBMirAFBVV95cUxPYnJQR2JxLVpPdzJGT2EwN0NFWXJRWHVyRmIzTWJDc3NGMWVWellsSENKdlVmNzZqZW5IVUhieUZLMW1iMWd6YzBnUTd5M2xhZEZmTHQ3TDkyY2I5OVd4YjlUOTB2c3UtWnVVcjFLdVN3dEkxa1ZEZTE2cXZTUkF5bUZYcjdhWkYxazFzUzN3Zl9nUHRZd01RS0Z0R2lWTWgwckdBWllrX2F1S0p6?oc=5'},
        {category:'flour',label:'Tepung & gandum',ingredient:'flour',image:'rmi-wheat.jpg',source:'Feedberry · melalui Google News',title:'Tepung Naik, Pedagang Cilor–Takoyaki Pilih Tahan Harga',description:'Artikel membahas respons pedagang terhadap tekanan biaya. Gunakan sebagai konteks, lalu konfirmasi harga supplier Anda.',context:'Bandingkan dampak beberapa asumsi harga sebelum mempertimbangkan penyesuaian porsi atau harga jual.',url:'https://news.google.com/rss/articles/CBMiiwFBVV95cUxQZG1zMlhBRUR0MXdRNVVxenZzUzVtcFBDQV9sV0c2U2p4bkNrNkJFNkVWMHJ5NkZYYV8zRXRGNXRtS05tN19ScG1LdnFCSkU1bFA3UWdURTZOV0p4aGNHcEk0VzI2ZnVwQVd1cHJ2NlJzbUg5d3lhSGpVVHlwbThNdi1lMG11bXM1Tkh3?oc=5'},
        {category:'food',label:'Pangan umum',ingredient:null,image:'rmi-market.jpg',source:'Suara Landak · melalui Google News',title:'Rupiah Melemah dan Harga Pangan Menekan Belanja Warga',description:'Sinyal ekonomi dan harga pangan dapat menjadi bahan diskusi untuk pembelian serta perencanaan biaya usaha.',context:'Pilih bahan yang relevan dan masukkan harga yang Anda ketahui. Tidak ada persentase harga yang diambil otomatis dari berita.',url:'https://news.google.com/rss/articles/CBMiaEFVX3lxTE4xYzdLbjVYR1dRWVF6Y3NFX3pwaEFpeGR2Uzh6NkozNThWOEYydm8zNVFvdHcyVkhJb1FnaVVER1RFMFVrS0VjLXhnSG12MVZwVGI3NXh0RFlzM3pxaXJfU2dudnhDRS1M?oc=5'}
    ];
    let mode = 'percent';
    let result = null;
    let contextText = '';
    let toastTimer;
    function scrollContainer() {
        let node = app.parentElement;
        while (node && node !== document.body) {
            if (/(auto|scroll)/.test(getComputedStyle(node).overflowY)) return node;
            node = node.parentElement;
        }
        return document.scrollingElement;
    }
    function syncScrollPadding() {
        const container = scrollContainer();
        if (container) app.style.setProperty('--rmi-scroll-padding', getComputedStyle(container).paddingTop);
    }
    syncScrollPadding();
    window.addEventListener('resize', syncScrollPadding);

    function showTab(name, focus = false) {
        const changed = app.querySelector('[data-rmi-tab][aria-selected="true"]').dataset.rmiTab !== name;
        app.querySelectorAll('[data-rmi-tab]').forEach(tab => {
            const selected = tab.dataset.rmiTab === name;
            tab.setAttribute('aria-selected', String(selected));
            tab.tabIndex = selected ? 0 : -1;
            if (selected && focus) tab.focus({preventScroll:true});
        });
        app.querySelectorAll('[role="tabpanel"]').forEach(panel => { panel.hidden = panel.id !== 'rmi-panel-' + name; });
        const container = scrollContainer();
        if (changed && container) container.scrollTop = 0;
    }
    function clearResult() {
        result = null;
        $('rmi-results').hidden = true;
        $('rmi-empty-results').hidden = true;
    }
    function scrollWithinPage(target) {
        const container = scrollContainer();
        if (!container) return;
        // Scroll only the content viewport. scrollIntoView also moved the outer shell,
        // allowing the fixed header and sticky tabs to cover the target on mobile.
        const offset = app.querySelector('.rmi-tabbar').offsetHeight + 20;
        container.scrollTo({top:container.scrollTop + target.getBoundingClientRect().top - container.getBoundingClientRect().top - offset,behavior:'instant'});
    }
    function readScenario(report) {
        const basePrice = $('rmi-base-price').valueAsNumber;
        const value = $('rmi-change').valueAsNumber;
        const ingredient = ingredients[$('rmi-ingredient').value];
        $('rmi-base-price').removeAttribute('aria-invalid');
        $('rmi-change').removeAttribute('aria-invalid');
        try {
            const newPrice = window.RmiSimulation.resolvePrice(basePrice, value, mode);
            $('rmi-form-error').hidden = true;
            return {basePrice,newPrice,ingredient,unit:ingredient.unit};
        } catch (error) {
            if (report) {
                $('rmi-form-error').textContent = error.message;
                $('rmi-form-error').hidden = false;
                const invalid = !Number.isFinite(basePrice) || basePrice <= 0 ? $('rmi-base-price') : $('rmi-change');
                invalid.setAttribute('aria-invalid', 'true');
                invalid.focus({preventScroll:true});
                scrollWithinPage(invalid);
            }
            return null;
        }
    }
    function refreshPrice() {
        const scenario = readScenario(false);
        $('rmi-price-preview').innerHTML = scenario ? escape(money(scenario.newPrice)) + ' <small>/ ' + escape(scenario.unit) + '</small>' : 'Belum valid';
    }
    function resetIngredient() {
        const ingredient = ingredients[$('rmi-ingredient').value];
        $('rmi-base-price').value = ingredient.base;
        $('rmi-change').value = mode === 'percent' ? 10 : window.RmiSimulation.resolvePrice(ingredient.base,10,'percent');
        app.querySelectorAll('.rmi-input-unit').forEach(el => {el.textContent = '/ ' + ingredient.unit;});
        $('rmi-change-suffix').textContent = mode === 'price' ? '/ ' + ingredient.unit : '%';
        $('rmi-recipe-count').textContent = ingredient.recipes.length ? ingredient.recipes.length + ' resep contoh terkait' : 'Belum ada resep terkait';
        $('rmi-form-error').hidden = true;
        clearResult();
        refreshPrice();
    }
    function startSimulation(key, title) {
        if (key) { $('rmi-ingredient').value = key; resetIngredient(); }
        $('rmi-story-context').hidden = !title;
        $('rmi-story-title').textContent = title || '';
        showTab('simulate');
        scrollWithinPage($('rmi-panel-simulate'));
        $('rmi-ingredient').focus({preventScroll:true});
    }
    function metric(label, value, detail) {
        return '<div class="rmi-card rmi-metric"><span>'+escape(label)+'</span><strong>'+escape(value)+'</strong><small>'+escape(detail)+'</small></div>';
    }
    function renderResult(scenario, rows) {
        result = {...scenario,rows};
        if (!rows.length) {
            $('rmi-empty-results').hidden = false;
            scrollWithinPage($('rmi-empty-results'));
            return;
        }
        const complete = rows.filter(row => row.complete);
        const partial = rows.filter(row => !row.complete);
        const change = (scenario.newPrice-scenario.basePrice)/scenario.basePrice*100;
        $('rmi-results-summary').textContent = scenario.ingredient.name + ': ' + money(scenario.basePrice) + ' → ' + money(scenario.newPrice) + ' / ' + scenario.unit + ' (' + (change>0?'+':'') + decimal.format(change) + '%). Harga jual dan takaran tetap.';
        const deltas = complete.map(row=>row.delta);
        const range = deltas.length ? (Math.min(...deltas) === Math.max(...deltas) ? signedMoney(deltas[0]) : signedMoney(Math.min(...deltas)) + ' – ' + signedMoney(Math.max(...deltas))) : 'Belum tersedia';
        $('rmi-result-metrics').innerHTML = metric('Harga pada skenario',money(scenario.newPrice),'Per '+scenario.unit+' · Input Manual') + metric('Perubahan biaya / porsi',range,'Pada '+complete.length+' resep contoh lengkap') + metric('Kelengkapan resep',complete.length+' lengkap',partial.length ? partial.length+' resep memiliki hasil parsial' : 'Seluruh resep contoh dapat dihitung');
        $('rmi-result-rows').innerHTML = rows.map((row,index)=>{
            const deltaClass=row.delta>0?'rmi-negative':row.delta<0?'rmi-positive':'rmi-neutral';
            const marginClass=row.marginDelta<0?'rmi-negative':row.marginDelta>0?'rmi-positive':'rmi-neutral';
            const marginText=row.marginDelta===null?'Harga jual atau biaya belum lengkap':(Math.abs(row.marginDelta)<1e-9?'Tetap':(row.marginDelta<0?'Turun ':'Naik ')+decimal.format(Math.abs(row.marginDelta))+' poin persentase');
            return '<tr><td data-label="Menu"><strong>'+escape(row.name)+'</strong><small>'+decimal.format(row.quantity)+' '+escape(row.quantityUnit)+' '+escape(scenario.ingredient.name.toLowerCase())+'</small><span class="rmi-badge '+(row.complete?'':'rmi-badge-amber')+'">'+(row.complete?'Data Simulasi':'Resep parsial')+'</span></td>'+
            '<td data-label="Biaya resep / porsi"><div>'+(row.complete?'<div class="rmi-cost-pair"><span>'+escape(money(row.beforeCost))+'</span><span>→</span><strong>'+escape(money(row.afterCost))+'</strong></div>':'<strong>Belum tersedia</strong><small>Biaya bahan lain belum lengkap</small>')+'</div></td>'+
            '<td data-label="Selisih / porsi"><div><strong class="'+deltaClass+'">'+escape(signedMoney(row.delta))+'</strong><small>'+(row.complete?'Biaya resep':'Bahan terpilih saja')+'</small></div></td>'+
            '<td data-label="Margin berbasis resep"><div>'+(row.afterMargin!==null?'<div class="rmi-cost-pair"><span>'+percent(row.beforeMargin)+'</span><span>→</span><strong>'+percent(row.afterMargin)+'</strong></div>':'<strong>Belum tersedia</strong>')+'<small class="'+marginClass+'">'+escape(marginText)+'</small></div></td>'+
            '<td data-label="Rincian"><button type="button" class="rmi-text-button" data-rmi-detail="'+index+'" aria-label="Lihat rincian '+escape(row.name)+'">Rincian '+icon('arrow')+'</button></td></tr>';
        }).join('');
        $('rmi-partial-note').hidden = !partial.length;
        $('rmi-partial-note').innerHTML = '<strong>'+partial.length+' resep belum lengkap</strong><p>'+partial.map(row=>escape(row.name)).join(', ')+': yang dihitung hanya biaya bahan terpilih. Total biaya resep dan margin belum tersedia.</p>';
        $('rmi-results').hidden = false;
        $('rmi-results-title').focus({preventScroll:true});
        scrollWithinPage($('rmi-results'));
    }
    function detail(index) {
        if (!result || !result.rows[index]) return;
        const row = result.rows[index];
        $('rmi-detail-title').textContent = row.name;
        const ratio = row.quantityUnit === 'g' || row.quantityUnit === 'ml' ? row.quantity/1000 : row.quantity;
        const pair=(label,text)=>'<div class="rmi-detail-row"><span>'+escape(label)+'</span><strong>'+escape(text)+'</strong></div>';
        $('rmi-detail-body').innerHTML = '<span class="rmi-badge">Resep contoh · Data Simulasi</span>'+pair('Bahan',result.ingredient.name)+pair('Takaran per porsi',quantity.format(row.quantity)+' '+row.quantityUnit+' = '+quantity.format(ratio)+' '+result.unit)+pair('Harga dasar',money(result.basePrice)+' / '+result.unit)+pair('Harga skenario',money(result.newPrice)+' / '+result.unit)+'<div class="rmi-detail-formula">'+quantity.format(ratio)+' '+result.unit+' × '+escape(money(result.newPrice))+' / '+result.unit+' = <strong>'+escape(money(row.afterIngredient))+'</strong> bahan terpilih per porsi.</div>'+pair('Biaya bahan terpilih',money(row.beforeIngredient)+' → '+money(row.afterIngredient))+pair('Biaya bahan lain (tetap)',row.otherCost===null?'Belum lengkap':money(row.otherCost))+pair('Total biaya resep',row.afterCost===null?'Belum tersedia':money(row.beforeCost)+' → '+money(row.afterCost))+pair('Harga jual (tetap)',row.sellingPrice===null?'Belum tersedia':money(row.sellingPrice))+pair('Margin berbasis resep',row.afterMargin===null?'Belum tersedia':percent(row.beforeMargin)+' → '+percent(row.afterMargin))+'<p style="margin-top:18px">'+(row.complete?'Biaya bahan resep belum mencakup tenaga kerja, overhead, dan biaya operasional.':'Biaya bahan lain belum lengkap. Hasil ini hanya estimasi biaya bahan terpilih, bukan HPP penuh atau margin menu.')+'</p>';
        $('rmi-detail-dialog').showModal();
    }
    function renderNews(filter='all') {
        const visible=news.map((article,index)=>({...article,index})).filter(article=>filter==='all'||article.category===filter);
        $('rmi-news-list').innerHTML=visible.map(article=>'<article class="rmi-card rmi-news-card"><div class="rmi-news-card-top"><span class="rmi-badge">'+escape(article.label)+'</span><img src="'+imageBase+article.image+'" alt="" width="58" height="58" loading="lazy"></div><div class="rmi-news-source">'+escape(article.source)+'<br>Arsip referensi · ilustrasi komoditas</div><h3>'+escape(article.title)+'</h3><p>'+escape(article.description)+'</p><div class="rmi-news-context"><strong>KONTEKS UNTUK USAHA</strong><p>'+escape(article.context)+'</p></div><div class="rmi-news-actions"><button type="button" class="rmi-button rmi-button-secondary" data-rmi-story="'+article.index+'">'+(article.ingredient?'Uji dampak tepung':'Pilih bahan untuk diuji')+icon('arrow')+'</button><a class="rmi-text-button" href="'+escape(article.url)+'" target="_blank" rel="noopener noreferrer">Buka tautan sumber '+icon('external')+'</a></div></article>').join('');
        $('rmi-news-empty').hidden=!!visible.length;
        app.querySelectorAll('[data-rmi-filter]').forEach(button=>button.setAttribute('aria-pressed',String(button.dataset.rmiFilter===filter)));
    }
    function openKachi() {
        if(!result)return;
        contextText='Tolong jelaskan dampak skenario berikut dan data yang perlu saya periksa.\n\n'+
            'Bahan: '+result.ingredient.name+'\nHarga manual: '+money(result.basePrice)+' → '+money(result.newPrice)+' / '+result.unit+'\nSumber: Input Manual + resep Data Simulasi. Hasil: Estimasi Simulasi.\n\n'+
            result.rows.map(row=>row.name+': '+(row.complete?'biaya resep '+money(row.beforeCost)+' → '+money(row.afterCost)+' / porsi; margin berbasis resep '+(row.afterMargin===null?'belum tersedia':percent(row.beforeMargin)+' → '+percent(row.afterMargin)): 'hasil parsial, bahan terpilih '+money(row.beforeIngredient)+' → '+money(row.afterIngredient)+' / porsi; total biaya dan margin belum tersedia')+'.').join('\n')+
            '\n\nAsumsi: takaran, biaya bahan lain, dan harga jual tetap. Belum termasuk tenaga kerja, overhead, atau seluruh biaya usaha. Harga pasar numerik dan data Core belum terhubung. Simulasi tidak mengubah data toko.\n\nMenu mana yang perlu saya periksa lebih dulu, dan data apa yang belum lengkap untuk menilai margin usaha?';
        $('rmi-kachi-context').textContent=contextText;
        $('rmi-kachi-dialog').showModal();
    }
    function toast(message) {
        clearTimeout(toastTimer);$('rmi-toast').textContent=message;$('rmi-toast').hidden=false;
        toastTimer=setTimeout(()=>{$('rmi-toast').hidden=true;},4500);
    }
    app.addEventListener('click',event=>{
        const button=event.target.closest('button');
        if(!button)return;
        if(button.dataset.rmiTab)showTab(button.dataset.rmiTab);
        if(button.dataset.rmiGo)showTab(button.dataset.rmiGo);
        if(button.dataset.rmiStart)startSimulation(button.dataset.rmiStart);
        if(button.dataset.rmiDialog)$(button.dataset.rmiDialog).showModal();
        if(button.hasAttribute('data-rmi-close'))button.closest('dialog').close();
        if(button.hasAttribute('data-rmi-detail'))detail(Number(button.dataset.rmiDetail));
        if(button.dataset.rmiFilter)renderNews(button.dataset.rmiFilter);
        if(button.hasAttribute('data-rmi-story')){const article=news[Number(button.dataset.rmiStory)];startSimulation(article.ingredient,article.title);}
    });
    app.querySelector('[role="tablist"]').addEventListener('keydown',event=>{
        if(!['ArrowLeft','ArrowRight','Home','End'].includes(event.key))return;
        const tabs=[...app.querySelectorAll('[data-rmi-tab]')];
        let index=tabs.indexOf(document.activeElement);
        if(index<0)return;
        event.preventDefault();
        index=event.key==='Home'?0:event.key==='End'?tabs.length-1:(index+(event.key==='ArrowRight'?1:-1)+tabs.length)%tabs.length;
        showTab(tabs[index].dataset.rmiTab,true);
    });
    app.querySelectorAll('dialog').forEach(dialog=>dialog.addEventListener('click',event=>{
        const bounds=dialog.getBoundingClientRect();
        if(event.target===dialog && (event.clientX<bounds.left||event.clientX>bounds.right||event.clientY<bounds.top||event.clientY>bounds.bottom))dialog.close();
    }));
    $('rmi-ingredient').addEventListener('change',()=>{resetIngredient();});
    ['rmi-base-price','rmi-change'].forEach(id=>$(id).addEventListener('input',()=>{clearResult();$('rmi-form-error').hidden=true;refreshPrice();}));
    app.querySelectorAll('[name="rmi-mode"]').forEach(radio=>radio.addEventListener('change',()=>{
        const previous=readScenario(false);mode=radio.value;
        $('rmi-change').value=mode==='price'?(previous?previous.newPrice:''):(previous?(previous.newPrice-previous.basePrice)/previous.basePrice*100:10);
        $('rmi-change-label').textContent=mode==='price'?'Harga baru (Rp)':'Perubahan harga (%)';
        $('rmi-change-suffix').textContent=mode==='price'?'/ '+ingredients[$('rmi-ingredient').value].unit:'%';
        $('rmi-change-help').textContent=mode==='price'?'Masukkan harga baru per satuan bahan terpilih.':'Gunakan angka negatif untuk menguji penurunan harga.';
        clearResult();refreshPrice();
    }));
    $('rmi-form').addEventListener('submit',event=>{
        event.preventDefault();clearResult();
        const scenario=readScenario(true);
        if(!scenario)return;
        const rows=window.RmiSimulation.simulate({...scenario,recipes:scenario.ingredient.recipes});
        renderResult(scenario,rows);
    });
    $('rmi-open-kachi').addEventListener('click',openKachi);
    $('rmi-copy-context').addEventListener('click',async()=>{
        try{await navigator.clipboard.writeText(contextText);$('rmi-kachi-dialog').close();toast('Konteks dan pertanyaan berhasil disalin.');}
        catch{toast('Clipboard belum tersedia. Pilih dan salin teks ringkasan secara manual.');}
    });
    renderNews();refreshPrice();
})();
