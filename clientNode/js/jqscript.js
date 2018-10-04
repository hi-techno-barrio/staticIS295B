$page = jQuery.noConflict()
$page(document).ready(function(){
	//setPage("nav");
	setNavigation();
	//alert($page(location).attr('search'));
	
	if($page(".projects").length >= 1){
		/*Left Sidebar Code Under Project Menu*/
		$page('.parent-submenu').click(function(){
		
			var _imenu= $page(this).parent();
			
			if(!_imenu.hasClass("active"))
			{
				$page('.active > ul').slideToggle();
				$page(".active").removeClass("active");
				$page(_imenu).addClass("active");
				$page(".active > ul").slideToggle();
			}
		
		});
		
		$page('.menu-item li').click(function(){
			if($page('.menu-item li').hasClass("currentsbm")){
				$page('.menu-item li ').removeClass("currentsbm");
			}
			$page(this).addClass("currentsbm");
		});
	
		/*------End Left Sidebar Code Under Project Menu-------*/
		
		/*To determine the type of system*/
			var proid = $page(".projects").attr('id');
			var sys = proid.split("-").splice(1).join().replace(",","-");
			switch(sys){
				case "aquisition":
					$page(".controller_buttons > div").hide();
					$page("#statusview").show();
					$page("#real_data_ctrls").show();
					break;
				case "data-controller":
					$page(".controller_buttons > div").hide();
					//$page("#statusview").hide();
					$page("#data-ctrls").show();
					break;
				case "system-setting":
					$page(".controller_buttons > div").hide();
					$page("#statusview").hide();
					break;
			}
			
		/*End to determine*/
	}
	
	/*About left Side Code*/
	
	$page("#link-abt > a").click(function(){
		$page(this).addClass("current-abt").siblings().removeClass("current-abt");
	});
	
	
	/*End About left Side Code*/
	
});

/*
	/chris/dynamiccbdv3/?action=admin
	How to activate menu highlight: Option 1
*/

function setNavigation(){
	var path = window.location.href;
	path = path.replace(/\/$/, "");
	path = decodeURIComponent(path);
	
	
	$page(".menu a").each(function(){
		var href = $page(this).attr('href');
		var n = path.indexOf("?");
		var phref = path.substring(n,path.length);
		
		if(phref === href)
			$page(this).closest('li').addClass('currentmenu');
	});
}

/*
	/chris/dynamiccbdv3/?action=admin
	How to activate menu highlight: Option 2
*/

function extractPageName(hrefString)
{
	var arr = hrefString.split('/');
	return  (arr.length<2) ? hrefString : arr[arr.length-2].toLowerCase() + arr[arr.length-1].toLowerCase();
}

function setActiveMenu(arr, crtPage)
{
	for (var i=0; i<arr.length; i++)
	{
		if(extractPageName(arr[i].href) == crtPage)
		{
			if (arr[i].parentNode.tagName != "DIV")
			{
				arr[i].className = "current";
				arr[i].parentNode.className = "currentmenu";
			}
		}
	}
}

function setPage(tag)
{	
	hrefString = document.location.href ? document.location.href : document.location;
	//document.getElementsByClassName(tag).style.background="red";
	console.log(document.getElementById(tag));
	if (document.getElementById(tag)!=null){
	//console.log(document.getElementsByClassName(tag).getElementsByTagName("a"));
	setActiveMenu(document.getElementById(tag).getElementsByTagName("a"), extractPageName(hrefString));
	}
}






