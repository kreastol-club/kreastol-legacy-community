const default_c = [
    '#61fcf1', //main
    '#61fcf17f', //main2
    '#72fff6ad', //secondary1
    '#7ED6FF', //secondary2
    '#45A29E', //secondary3
    '#0b0c10', //background1
    '#0b0c1067', //background2
    '#252629', //color1
    '#c5c6c7']; //color2

const blue_c = [
    '#1a25ff',
    '#1a71ff7f',
    '#4178ff',
    '#7ED6FF',
    '#316e98',
    '#0b0c10',
    '#0b0c1067',
    '#252629',
    '#c5c6c7'];

const purple_c = [
    '#9300c5',
    '#AC2ECF7f',
    '#d866ff',
    '#c36fdb',
    '#75009b',
    '#0b0c10',
    '#0b0c1067',
    '#252629',
    '#c5c6c7'];

const red_c = [
    '#ff1728',
    '#ff28387f',
    '#b70007',
    '#fc2e34',
    '#a24545',
    '#0b0c10',
    '#0b0c1067',
    '#252629',
    '#c5c6c7'];

const yellow_c = [
    '#faf718',
    '#b5ac287f',
    '#ba9500',
    '#ffed6e',
    '#beaa27',
    '#0b0c10',
    '#0b0c1067',
    '#252629',
    '#c5c6c7'];

const orange_c = [
    '#ff8300',
    '#d076167f',
    '#fc8d31',
    '#ffa336',
    '#b76923',
    '#0b0c10',
    '#0b0c1067',
    '#252629',
    '#c5c6c7'];

let root = document.documentElement;
document.querySelector("#default-color-d").addEventListener("click", switchDef);
document.querySelector("#blue-d").addEventListener("click", switchBlue);
document.querySelector("#purple-d").addEventListener("click", switchPurple);
document.querySelector("#red-color-d").addEventListener("click", switchRed);
document.querySelector("#yellow-d").addEventListener("click", switchYellow);
document.querySelector("#orange-d").addEventListener("click", switchOrange);

document.querySelector("#default-color").addEventListener("click", switchDef);
document.querySelector("#blue").addEventListener("click", switchBlue);
document.querySelector("#purple").addEventListener("click", switchPurple);
document.querySelector("#red-color").addEventListener("click", switchRed);
document.querySelector("#yellow").addEventListener("click", switchYellow);
document.querySelector("#orange").addEventListener("click", switchOrange);


if (typeof sessionStorage.color === 'undefined') {
    sessionStorage.color = 'default';
}


function changeColor(){
    switch(sessionStorage.color){
        case 'blue':
            switchBlue();
            break;
        case 'purple':
            switchPurple();
            break;
        case 'red':
            switchRed();
            break;
        case 'yellow':
            switchYellow();
            break;
        case 'orange':
            switchOrange();
            break;
        case 'default':
            switchDef();
    }
}
changeColor();



function switchDef(){
    root.style.setProperty('--main', default_c[0]);
    root.style.setProperty('--main2', default_c[1]);
    root.style.setProperty('--secondary1', default_c[2]);
    root.style.setProperty('--secondary2', default_c[3]);
    root.style.setProperty('--secondary3',default_c[4]);
    root.style.setProperty('--background1',default_c[5] );
    root.style.setProperty('--background2', default_c[6]);
    root.style.setProperty('--color1',default_c[7]);
    root.style.setProperty('--color2',default_c[8]);
    sessionStorage.color = 'default';
}

function switchBlue(){

    root.style.setProperty('--main', blue_c[0]);
    root.style.setProperty('--main2', blue_c[1]);
    root.style.setProperty('--secondary1', blue_c[2]);
    root.style.setProperty('--secondary2', blue_c[3]);
    root.style.setProperty('--secondary3',blue_c[4]);
    root.style.setProperty('--background1',blue_c[5] );
    root.style.setProperty('--background2', blue_c[6]);
    root.style.setProperty('--color1',blue_c[7]);
    root.style.setProperty('--color2',blue_c[8]);
    sessionStorage.color = 'blue';
}function switchPurple(){
    root.style.setProperty('--main', purple_c[0]);
    root.style.setProperty('--main2', purple_c[1]);
    root.style.setProperty('--secondary1', purple_c[2]);
    root.style.setProperty('--secondary2', purple_c[3]);
    root.style.setProperty('--secondary3',purple_c[4]);
    root.style.setProperty('--background1',purple_c[5] );
    root.style.setProperty('--background2', purple_c[6]);
    root.style.setProperty('--color1',purple_c[7]);
    root.style.setProperty('--color2',purple_c[8]);
}

function switchRed(){
    root.style.setProperty('--main', red_c[0]);
    root.style.setProperty('--main2', red_c[1]);
    root.style.setProperty('--secondary1', red_c[2]);
    root.style.setProperty('--secondary2', red_c[3]);
    root.style.setProperty('--secondary3',red_c[4]);
    root.style.setProperty('--background1',red_c[5] );
    root.style.setProperty('--background2', red_c[6]);
    root.style.setProperty('--color1',red_c[7]);
    root.style.setProperty('--color2',red_c[8]);
    sessionStorage.color = 'red';

}
function switchYellow(){
    root.style.setProperty('--main', yellow_c[0]);
    root.style.setProperty('--main2', yellow_c[1]);
    root.style.setProperty('--secondary1', yellow_c[2]);
    root.style.setProperty('--secondary2', yellow_c[3]);
    root.style.setProperty('--secondary3',yellow_c[4]);
    root.style.setProperty('--background1',yellow_c[5] );
    root.style.setProperty('--background2', yellow_c[6]);
    root.style.setProperty('--color1',yellow_c[7]);
    root.style.setProperty('--color2',yellow_c[8]);
    sessionStorage.color = 'yellow';

}
function switchOrange(){
    root.style.setProperty('--main', orange_c[0]);
    root.style.setProperty('--main2', orange_c[1]);
    root.style.setProperty('--secondary1', orange_c[2]);
    root.style.setProperty('--secondary2', orange_c[3]);
    root.style.setProperty('--secondary3',orange_c[4]);
    root.style.setProperty('--background1',orange_c[5] );
    root.style.setProperty('--background2', orange_c[6]);
    root.style.setProperty('--color1',orange_c[7]);
    root.style.setProperty('--color2',orange_c[8]);
    sessionStorage.color = 'orange';

}


