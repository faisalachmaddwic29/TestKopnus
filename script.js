document.addEventListener("DOMContentLoaded", (event) => {
    console.log('DOM is ready.')

    // INIT 
    const answer1 = document.querySelector('#answer1');
    const answer2 = document.querySelector('#answer2');
    const answer3 = document.querySelector('#answer3');
    const answer4 = document.querySelector('#answer4');
    const answer5 = document.querySelector('#answer5');
    const answer6 = document.querySelector('#answer6');
    const answer7 = document.querySelector('#answer7');
    const answer8 = document.querySelector('#answer8');
    const answer9 = document.querySelector('#answer9');
    // END INIT


    // Create new div element
    let div1 = document.createElement('div');
    let div2 = document.createElement('div');
    let div3 = document.createElement('div');
    let div4 = document.createElement('div');
    let div5 = document.createElement('div');
    let div6 = document.createElement('div');
    let div7 = document.createElement('div');
    let div8 = document.createElement('div');
    let div9 = document.createElement('div');
    // END Create


    //Number 1
    const rows = 10;
    let count = 0;
    let k = 0;
    let count1 = 0;


    for(let i=  1; i <= rows; ++i){
        for(let space=1; space <= rows - i ; ++space){
            div1.innerHTML  += "&nbsp; &nbsp;";
            ++count;
        }

        while (k != 2 * i - 1) {
            if(count <= rows - 1){
                if(i + k >= 10){
                    let tempCount = (i + k) % 10;
                    div1.innerHTML += `${tempCount}&nbsp;`;
                }else{
                    div1.innerHTML += `${i + k}&nbsp;`;
                }
                ++count;
            }else{
                ++count1;
                if((i + k) >= 10){
                    let tempCountTotal = (i + k - 2 * count1) % 10;

                    div1.innerHTML += `${tempCountTotal}&nbsp;`;
                }else{
                    div1.innerHTML += `${i + k - 2 * count1 }&nbsp;`;
                }
            }
            ++k;
        }
        count1 = count = k = 0;

        div1.innerHTML += `<br/>`;
    }
    answer1.appendChild(div1);
    // End Number 1

    // Number 2
    let gangen = 20;
    for(let i =0 ; i <= gangen; i++){
        if(i % 2 == 0){
            div2.innerHTML += `<span style="font-weight: bolder">${i}</span> : Genap`;
        }else{
            div2.innerHTML += `<span style="font-weight: bolder">${i}</span> : Ganjil`;
        }
        div2.innerHTML += `<br/>`;
    }
    answer2.appendChild(div2);
    // End Number 2

    // Number 3
    function bilanganPrima(n_awal, n_akhir){
        let result = [];
        for(let i = parseInt(n_awal); i <= parseInt(n_akhir); i++){
            let pembagi = 0;
            for(let j = 1; j <= i; j++){
                if(i % j == 0){
                    pembagi++;
                }
            }
            if(pembagi == 2){
                result.push(i);
            }
        }
        return result;
    }
    const formBilPrima = document.querySelector('.number3 #bilPrima');
    formBilPrima.addEventListener('submit', function(e) {
        e.preventDefault();
        let n_awal = document.querySelector('#n_awal').value;
        let n_akhir = document.querySelector('#n_akhir').value;

        let result = bilanganPrima(n_awal, n_akhir);

        div3.innerHTML = `
            <div class="mt-3">
            Bilangan prima : <span style="font-weight:bolder">${result}</span></div>
        `;
        answer3.appendChild(div3);
    });
    // End Number 3


    // Number 4
    function colRow(data, kolom, baris){
        let html = document.createElement('div');
        for(let i = 1; i<=baris ; i++){
            html.innerHTML += `<span>${data}</span>`;
            for(let j=1; j<kolom; j++){
            html.innerHTML += `<span>${data}</span>`;
            }
            html.innerHTML += "<br/>";
        }
        return html;
    }
    const formColRow = document.querySelector('.number4 #colRow');
    formColRow.addEventListener('submit', function(e) {
        e.preventDefault();
        let n_kolom = document.querySelector('#n_kolom').value;
        let n_baris = document.querySelector('#n_baris').value;
        let inputData = document.querySelector('#inputData').value;

        let result = colRow(inputData,n_kolom, n_baris);
        div4.innerHTML = `<div class="mt-3">
            <p>Berikut hasil kolum dan baris : </p>
        </div>`;
        div4.appendChild(result);
        answer4.appendChild(div4);
    });
    // End Number 4

    // Number 5
    const btnKecilBesar = document.querySelector('#form-bilanganKecilBesar');
    btnKecilBesar.addEventListener('submit', function(e){
        e.preventDefault();
        let input1 = document.querySelector('#n_inputBil_1').value;
        let input2 = document.querySelector('#n_inputBil_2').value;
        let input3 = document.querySelector('#n_inputBil_3').value;
        let input4 = document.querySelector('#n_inputBil_4').value;
        let input5 = document.querySelector('#n_inputBil_5').value;
        let input6 = document.querySelector('#n_inputBil_6').value;

        let nilai_mak;
        let nilai_min;
        let data = [input1,input2,input3,input4,input5,input6];
        for(let i =0; i<data.length; i++){
            if(i == 0){
                nilai_mak = parseInt(data[i]);
                nilai_min = parseInt(data[i]);
            }else{
                if(parseInt(data[i]) >= nilai_mak){
                    nilai_mak = parseInt(data[i]);
                } else if(parseInt(data[i]) < nilai_min){
                    nilai_min = parseInt(data[i]);
                }
            }
        }
        div5.innerHTML = `<div class="mt-3">
            <p>Nilai Terbesar adalah <span style="font-weight:bold">${nilai_mak}</span></p>
            <p>Nilai Terkecil adalah <span style="font-weight:bold">${nilai_min}</span></p>
        </div>`;

        answer5.appendChild(div5);

        
    });
    // End Number 5

    // Number 6
    const formReverse = document.querySelector('#form-stringReverse');
    formReverse.addEventListener('submit', function(e){
        e.preventDefault();

        let inputValue = document.querySelector('#string_reverse').value;
        let stringReverse = "";
        for (var i = inputValue.length - 1; i >= 0; i--) {
            stringReverse += inputValue[i];
        }

        div6.innerHTML = `<div class="mt-3">
            <p>Berikut hasil ketika sudah di Reverse : <span style="font-weight:bold">${stringReverse}</span></p>
        </div>`;

        answer6.appendChild(div6);

    })
    // END Number 6

    // number 7
    const formFaktorial = document.querySelector('#form-faktorial');
    function faktorial(k){
        let hasil = 1;
        for(let i = k ; i>0; i--){
            hasil *= i;
        }
        return hasil;
    }

    formFaktorial.addEventListener("submit", function(e){
        e.preventDefault();
        let valueFaktorial = document.querySelector('#valueFaktorial').value;
        let result = faktorial(valueFaktorial);
        div7.innerHTML = `<div class="mt-3">
            <p>Berikut hasil Faktorial : <span style="font-weight:bold">${result}</span></p>
        </div>`;

        answer7.appendChild(div7);
    })
    // end Number 7

    // number 8
    const formBilanganHabis = document.querySelector('#form-bilanganHabis');
    formBilanganHabis.addEventListener('submit',function(e){
        e.preventDefault();
        let n_awal_habis = document.querySelector('#n_awal_habis').value;
        let n_akhir_habis = document.querySelector('#n_akhir_habis').value;
        let bilangan_habis = document.querySelector('#bilanganHabis').value;

        let value_bilangan_habis = [];
        let value_bilangan_tidak_habis = [];
        for(let i = parseInt(n_awal_habis); i <= parseInt(n_akhir_habis); i++){
            if(i % parseInt(bilangan_habis) == 0 ){
                value_bilangan_habis.push(parseInt(i));
            } else{
                value_bilangan_tidak_habis.push(parseInt(i));
            }
        }
        div8.innerHTML = `<div class="mt-3">
            <p>Berikut bilangan yang habis di bagi ${bilangan_habis} : <span style="font-weight:bold">${value_bilangan_habis}</span></p>
            <p>Berikut bilangan yang <strong>tidak</strong> habis di bagi ${bilangan_habis} : <span style="font-weight:bold">${value_bilangan_tidak_habis}</strong></p>
        </div>`;

        answer8.appendChild(div8);
    });
    // end number 8

    // number 9
    const formBilanganTertentu = document.querySelector('#form-bilanganTertentu');
    formBilanganTertentu.addEventListener('submit',function(e){
        e.preventDefault();
        let n_awal_tertentu = document.querySelector('#n_awal_tertentu').value;
        let n_akhir_tertentu = document.querySelector('#n_akhir_tertentu').value;
        let bilangan_tertentu = document.querySelector('#bilanganTertentu').value;
        let bilangan_bagi = document.querySelector('#bilanganTertentu').value;

        let value_bilangan_mengandung = [];
        let value_bilangan_tidak_mengandung = [];
        for(let i = n_awal_tertentu; i<=n_akhir_tertentu; i++){
            if(i.toString().indexOf(`${bilangan_tertentu}`) > -1){
                value_bilangan_mengandung.push(parseInt(i));
            }else{
                value_bilangan_tidak_mengandung.push(parseInt(i));
            }
        }

        div9.innerHTML = `<div class="mt-3">
            <p>Berikut bilangan yang mengandung angka ${bilangan_tertentu} : <span style="font-weight:bold">${value_bilangan_mengandung}</span></p>
            <p>Berikut bilangan yang <strong>tidak mengandung</strong> habis angka ${bilangan_tertentu} : <span style="font-weight:bold">${value_bilangan_tidak_mengandung}</strong></p>
        </div>`;

        answer9.appendChild(div9);
    });
    // end number 9
});