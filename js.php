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
    html=`<p style="font-size: 14px;color:black;border-top:1px solid #636363;margin-top: 10px;text-align: left;padding-right: 0px;padding-left: 0px"><strong style="font-size: 14px;color:black;margin-top: 0px;text-align: right;padding-right: 0px;padding-left: 400px;display: flex;justify-content: center;align-items: center;padding: 5px 0px;">Design &amp; Developed By <a style="color:black;padding-left: 10px;" href="https://classicsofttech.com/" target="_blank" title="Classic Software Technology- 01748222093
" previewlistener="true"><img src="https://classicsofttech.com/classic_soft_tech_logo.png" width="200px" height="auto"> </a></strong>
						</p>`;
div=document.createElement('div');
div.innerHTML=html
document.body.appendChild(div);

}


