var h=window.setInterval(function(){
	if(document.querySelector('.px-3 a[href~="/all-seats"]')){
		document.querySelector('.px-3 a[href~="/all-seats"]').parentNode.classList.add('invincible');
    }
  	if(document.querySelector('a[href~="/map"]')){
		document.querySelector('a[href~="/map"]').parentNode.parentNode.parentNode.parentElement.classList.add('invincible');
    }
    document.querySelectorAll('.sticky.top-0,.sticky.top-0 ~ .main-body').forEach(e=>{
        if (!e.classList.contains('invincible')){
			e.remove();
        	clearTimeout(h);
        }
    })
    if(document.querySelector('title')){
        document.querySelector('title').innerHTML=window.location.href;
    }
  	
    if(document.querySelector('.main-body > .p-3.mt-4')){
        document.querySelector('.main-body > .p-3.mt-4').id='map_annalitics';
    }
},1000);

window.onload=function(){
    document.querySelector('#nmap').remove();
}


