var Advertiser={INFO:{CookieName:"DERDB"},GADC:{CookieName:"GADC",UserInfoKey:"EUD"},Login:{LoginCookieName:"Login",isLogin:function(){regEx=new RegExp(this.LoginCookieName+"[=;]","i");cookies=document.cookie.substring(0)+";";if(cookies.search(regEx)==-1){return false}return true}},Util:{CookieDomain:".myspace.com",RandomSeed:Date.parse(new Date()),_documentURL:decodeURI(document.URL),Encode64:function(D){var B="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";var A="";var K,I,G,J,H,F,E="";var C=0;do{K=D.charCodeAt(C++);I=D.charCodeAt(C++);G=D.charCodeAt(C++);J=K>>2;H=((K&3)<<4)|(I>>4);F=((I&15)<<2)|(G>>6);E=G&63;if(isNaN(I)){F=E=64}else{if(isNaN(G)){E=64}}A=A+B.charAt(J)+B.charAt(H)+B.charAt(F)+B.charAt(E);K=I=G="";J=H=F=E=""}while(C<D.length);return A},Decode64:function(D){var B="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";var A="";var K,I,G,J,H,F,E="";var C=0;D=D.replace(/[^A-Za-z0-9\+\/\=]/g,"");do{J=B.indexOf(D.charAt(C++));H=B.indexOf(D.charAt(C++));F=B.indexOf(D.charAt(C++));E=B.indexOf(D.charAt(C++));K=(J<<2)|(H>>4);I=((H&15)<<4)|(F>>2);G=((F&3)<<6)|E;A=A+String.fromCharCode(K);if(F!=64){A=A+String.fromCharCode(I)}if(E!=64){A=A+String.fromCharCode(G)}K=I=G="";J=H=F=E=""}while(C<D.length);return A},SetCookie:function(D,C,A){var B=D+"="+C+"; path=/;";if(Advertiser.Util.CookieDomain!=""){B+=" domain="+Advertiser.Util.CookieDomain+";"}if(A!=null){B+=" expires="+A+";"}document.cookie=B},RemoveCookie:function(A){if(this.CookieDomain==""){document.cookie=A+"=; expires=Wed, 19-Jan-2005 08:28:17 GMT; path=/"}else{document.cookie=A+"=; domain="+Advertiser.Util.CookieDomain+"; expires=Wed, 19-Jan-2005 08:28:17 GMT; path=/"}},ReadCookie:function(A){regEx=new RegExp(A+"=([^;]*)","i");if(document.cookie.search(regEx)==-1){return null}return RegExp.$1},ReadCookieKey:function(C,B){var A=this.ReadCookie(C);if(A!=null){regEx=new RegExp(B+"=([^&]*)","i");if(A.search(regEx)==-1){return null}return RegExp.$1}return null},ReadKey:function(B,A){if(B!=null){regEx=new RegExp(A+"=([^&]*)","i");if(B.search(regEx)==-1){return null}return RegExp.$1}return null},SetKey:function(D,A,C){if(D.indexOf(A+"=")!=-1){var B=A+"="+C;regEx=new RegExp(A+"=([^&]*)","i");D=D.replace(regEx,B)}else{D=D+"&"+A+"="+C}return D},AddToCookie:function(G,D,F,A){var C=null;if(!A){C=new Date();C.setYear(C.getFullYear()+1);C=C.toGMTString()}var E=null;var B=Advertiser.Util.ReadCookie(G);if(B!=null){E=Advertiser.Util.Decode64(unescape(B))}if(E!=null){E=Advertiser.Util.SetKey(E,D,F);Advertiser.Util.SetCookie(G,Advertiser.Util.Encode64(E),C)}},IsDefined:function(name){if(name===null||name===""){return false}var checkParts=true;if(this.IsDefined.arguments.length==2){checkParts=this.IsDefined.arguments[1]}var nameParts=new Array();if(checkParts){nameParts=name.split(".")}else{nameParts[0]=name}var nameCheck=nameParts[0];var type=eval("typeof("+nameCheck+")");if(type=="undefined"){return false}for(var i=1;i<nameParts.length;i++){nameCheck+="."+nameParts[i];var v=eval("typeof("+nameCheck+")");if(v=="undefined"){return false}}return true},AddEvent:function(D,C,A){if(D.addEventListener){D.addEventListener(C,A,false);return true}else{if(D.attachEvent){var B=D.attachEvent("on"+C,A);return B}else{return false}}}},SDC:{DisplayedFriendEUD:"",PixelSrc:"http://seg.fimserve.com/relay?",targetValuesSet:false,setTargetValues:function(){var B=Advertiser.Util.ReadCookie(Advertiser.INFO.CookieName);if(B!=null){B=Advertiser.Util.Decode64(B)}if(B==null||B.length===0){return}var A=Advertiser.Util.ReadKey(B,"cultuserpref");try{if(!Advertiser.SDC.targetValuesSet&&(pagefc==="User"||pagefc==="LoginTakeOver")){if(A==="21514"){sdcculture=16}}Advertiser.SDC.targetValuesSet=true}catch(C){}},writePixel:function(){if(navigator.userAgent.indexOf("GOMEZ")>-1){return}derdbValue=Advertiser.Util.ReadCookie(Advertiser.INFO.CookieName);googleValue=Advertiser.Util.ReadCookieKey(Advertiser.GADC.CookieName,Advertiser.GADC.UserInfoKey);if((derdbValue==null||derdbValue.length==0)&&(googleValue==null||googleValue.length==0)){return}fimpixelsrc=Advertiser.SDC.PixelSrc;if(derdbValue!=null&&derdbValue.length!=0){fimpixelsrc+="payload="+derdbValue;if(googleValue!=null&&googleValue.length!=0){fimpixelsrc+="&"}}if(googleValue!=null&&googleValue.length!=0){fimpixelsrc+="eud="+googleValue}fimpixelstyle="display:none; position:absolute; left:0px; top:0px; border-width:0px;height:1px;width:1px;";fimpixel=document.createElement("img");fimpixel.setAttribute("src",fimpixelsrc);fimpixel.setAttribute("style",fimpixelstyle);fimpixel.style.display="none";document.getElementsByTagName("body")[0].appendChild(fimpixel);Advertiser.Util.RemoveCookie(Advertiser.Login.LoginCookieName)},AllowRefresh:true,AdsRendered:new Object},CMS:{BlueLithium:"myspace_bluelithium"},Refresher:{ActiveAd:"",PendingAdCalls:new Object,AutoList:new Object,IsFocused:true,FocusEventsAdded:false,Focus:function(){if(!Advertiser.Refresher.IsFocused){Advertiser.Refresher.IsFocused=true;Advertiser.Refresher.RefreshPendingAdCalls()}},Blur:function(){Advertiser.Refresher.IsFocused=false},AddFocusEvents:function(){if(!Advertiser.Refresher.FocusEventsAdded){if(Advertiser.Util.Browser.isMac&&Advertiser.Util.Browser.isFirefox&&Advertiser.Util.Browser.versionMajor<3){Advertiser.SDC.AllowRefresh=false}else{if(Advertiser.Util.Browser.isIE){document.onfocusout=function(){Advertiser.Refresher.Blur()};document.onfocusin=function(){Advertiser.Refresher.Focus()}}else{window.onblur=function(){Advertiser.Refresher.Blur()};window.onfocus=function(){Advertiser.Refresher.Focus()}}}Advertiser.Refresher.FocusEventsAdded=true}},AutoRefreshAd:function(tokenID){if(!Advertiser.SDC.AllowRefresh&&Advertiser.SDC.AdsRendered[tokenID]){return}var refreshingAd=Advertiser.Refresher.AutoList[tokenID];if(refreshingAd==null){return}if(Advertiser.Refresher.IsFocused&&Advertiser.Refresher.ActiveAd!==tokenID&&refreshingAd.AdCall!=null){eval(refreshingAd.AdCall);var refresh="Advertiser.Refresher.AutoRefreshAd('"+tokenID+"')";var delay=refreshingAd.Delay;if(delay>0){setTimeout(refresh,delay)}}else{Advertiser.Refresher.PendingAdCalls[tokenID]=refreshingAd.AdCall}},RefreshPendingAdCalls:function(){for(var tokenID in Advertiser.Refresher.PendingAdCalls){var adCall=Advertiser.Refresher.PendingAdCalls[tokenID];if(adCall!==""){Advertiser.Refresher.PendingAdCalls[tokenID]="";var refreshingAd=Advertiser.Refresher.AutoList[tokenID];if(refreshingAd!=null){Advertiser.Refresher.AutoRefreshAd(tokenID)}else{eval(adCall)}}}},SetActiveAd:function(A){Advertiser.Refresher.ActiveAd=A},ReleaseActiveAd:function(){Advertiser.Refresher.ActiveAd="";Advertiser.Refresher.RefreshPendingAdCalls()}},DFP:{LeaderboardDivs:new Array("tkn_leaderboard","tkn_leaderboardband","tkn_leaderboardsonybmg","tkn_leaderboardwmg","tkn_leaderboardumg","tkn_leaderboardemi","tkn_leaderboardmerlin","tkn_leaderboardioda","tkn_leaderboardorchard"),MedRecDivs:new Array("tkn_medrec","tkn_medrecband","tkn_medrecsonybmg","tkn_medrecwmg","tkn_medrecumg","tkn_medrecemi","tkn_medrecmerlin","tkn_medrecioda","tkn_medrecorchard"),AdsRoadBlocked:false,AdsDetermined:false,TimeoutCounts:new Object,HasVideoPlayer:function(){var B=document.getElementById("flashy");var A=document.getElementById("tv_vid_player_comp");if(B!==null||A!==null){return true}return false},HasHuluPlayer:function(){var A=document.getElementById("NS_FLASH_logoComponent");if(A!=null){var B=A.getAttribute("src");if(B!=null&&B.indexOf("player.hulu.com")!=-1){return true}}else{var C=document.getElementById("tv_vid_player_hulu_lb");if(C!=null&&C.style.display!="none"){return true}}return false},SetAdsRoadBlocked:function(A){Advertiser.DFP.AdsRoadBlocked=A;Advertiser.DFP.AdsDetermined=true},CallHouseBanner:function(F){if(F==null){return}var H;var J;var B=F.split(";");for(D=0;D<B.length;D++){var C=B[D].split("=");if(C.length===2){if(C[0]==="page"){H=C[1]}else{if(C[0]==="pos"){J=C[1]}}}}if(H!="91000017"&&H!="21003206"&&H!="21003306"){return}var E="http://ad.doubleclick.net/adi/myspace.video/;";var A;var K;var G;if(J==="leaderboard"){for(var D=0;D<Advertiser.DFP.LeaderboardDivs.length;D++){G=document.getElementById(Advertiser.DFP.LeaderboardDivs[D]);if(G!=null){break}}E+="kw=house=lb;sz=728x90;";A=728;K=90}else{if(J==="mrec"){for(var D=0;D<Advertiser.DFP.MedRecDivs.length;D++){G=document.getElementById(Advertiser.DFP.MedRecDivs[D]);if(G!=null){break}}E+="kw=house=mr;sz=300x250;";A=300;K=250}}if(G==null){return}var I=AdHelper.get_randomNumber().substring(2,11);E+=F+"adid=na;tile1;ord="+I;G.innerHTML='<iframe src="'+E+'" id="house_ad" width="'+A+'" height="'+K+'" marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling=no></iframe>'},LoadRoadBlock:function(F,E,A,C){var B=null;if(F==="tkn_medrec"){for(var D=0;D<Advertiser.DFP.MedRecDivs.length;D++){B=document.getElementById(Advertiser.DFP.MedRecDivs[D]);if(B!==null){break}}}else{if(F==="tkn_leaderboard"){for(var D=0;D<Advertiser.DFP.LeaderboardDivs.length;D++){B=document.getElementById(Advertiser.DFP.LeaderboardDivs[D]);if(B!==null){break}}}else{B=document.getElementById(F)}}if(B!==null){B.innerHTML='<iframe src="'+C+'" id="ifr_companion" width="'+E+'" height="'+A+'" marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling=no></iframe>';return true}return false}}};function BrowserDetection(){var A=navigator.userAgent.toLowerCase();this.isGecko=(A.indexOf("gecko")!=-1&&A.indexOf("safari")==-1);this.isSafari=(A.indexOf("safari")!=-1);this.isIE=(A.indexOf("msie")!=-1&&(A.indexOf("webtv")==-1));this.versionMinor=parseFloat(navigator.appVersion);if(this.isGecko){this.versionMinor=parseFloat(A.substring(A.indexOf("/",A.indexOf("gecko/")+6)+1))}else{if(this.isIE&&this.versionMinor>=4){this.versionMinor=parseFloat(A.substring(A.indexOf("msie ")+5))}else{if(this.isSafari){this.versionMinor=parseFloat(A.substring(A.lastIndexOf("safari/")+7))}}}this.versionMajor=parseInt(this.versionMinor,10);this.isWin=(A.indexOf("win")!=-1);this.isMac=(A.indexOf("mac")!=-1);this.isIE6x=(this.isIE&&this.versionMajor==6);this.isIE6up=(this.isIE&&this.versionMajor>=6);this.isFirefox=A.indexOf("firefox")>-1}Advertiser.Util.Browser=new BrowserDetection();var AdHelper={_ad_randomseed:Date.parse(new Date()),_randomNumber:"",_adCount:1,_friendId:null,_infoCookieValue:null,_functionalContext:"",_keys:[],_values:[],_livePreviewUrl:null,_qsParsed:false,_documentURL:document.URL,_setRandom:function(){var C=714025;var D=4096;var A=150889;var B=(this._ad_randomseed*D+A)%C;return B/C},_parseQueryString:function(){this._qsParsed=true;var D=decodeURI(this._documentURL);var G=D.indexOf("?")==-1?"":D.substring(D.indexOf("?")+1);var F=G.split("&");var B=F.length;for(var C=0;C<B;C++){var H=F[C].indexOf("=");if(H>=0){var A=F[C].substring(0,H);var E=F[C].substring(H+1);this._keys[this._keys.length]=A;this._values[this._values.length]=E}}},get_adCount:function(){return this._adCount},set_adCount:function(A){this._adCount=A},incrementAdCount:function(){this._adCount++},getDecodedURL:function(){return decodeURI(this._documentURL)},getFunctionalContext:function(){if(this._functionalContext===""){if(Advertiser.Util.IsDefined("MySpace.ClientContext.FunctionalContext")){this._functionalContext=MySpace.ClientContext.FunctionalContext}else{if(Advertiser.Util.IsDefined("MySpaceClientContext.FunctionalContext")){this._functionalContext=MySpaceClientContext.FunctionalContext}}}return this._functionalContext},queryString:function(D){var B=this.queryString.arguments;var F=true;if(B.length===2){F=B[1]}if(!this._qsParsed){this._parseQueryString()}var E=null;var A=this._keys.length;for(var C=0;C<A;C++){if(this._keys[C]==D){E=escape(this._values[C]);break}}if(E==null||!F){return E}else{return E.toLowerCase()}},getID:function(B){var A=this.queryString(B);if(A!=null){return A}else{return 0}},getVar:function(name){var v=eval("typeof("+name+")");if(v=="undefined"){return null}return eval(name)},getVarOrId:function(C,B){var A=this.getVar(C);if(A==null){return null}else{if(A!=0){return A}else{return this.getID(B)}}},getTVCatMasterId:function(){var A=this.getVar("tvcatmasterid");if(A==null||isNaN(A)){return null}switch(A){case 1:case 2:A=0;break;case 7:A=300;break;case 9:A=100;break;case 15:A=200;break;case 8:A=1001;break;default:break}return A},getTVChannelID:function(){if(AdHelper.getVar("ChannelID")>0){return AdHelper.getVar("ChannelID")}if(AdHelper.getVar("tvchanid")>0){return AdHelper.getVar("tvchanid")}return null},getTVVideoID:function(){if(AdHelper.getVar("videoid")>0){return AdHelper.getVar("videoid")}if(AdHelper.getVar("videoID")>0){return AdHelper.getVar("videoID")}return null},get_friendId:function(){if(this._friendId!=null){return this._friendId}if(Advertiser.Util.IsDefined("MySpace.ClientContext.DisplayFriendId")&&MySpace.ClientContext.DisplayFriendId>0){this._friendId=MySpace.ClientContext.DisplayFriendId}else{var C=this._documentURL;C=C.replace(/'/g,"");var B=new RegExp("\\?[\\w\\W]*(friendid|channelid|groupid)=([^\\&\\?#]*)","i");var A=B.exec(C);if(A&&A.length>1){this._friendId=A[2]}}return this._friendId},getInfoCookie:function(){if(this._infoCookieValue!=null){return this._infoCookieValue}this._infoCookieValue=Advertiser.Util.ReadCookie(Advertiser.INFO.CookieName);if(this._infoCookieValue!=null){this._infoCookieValue=Advertiser.Util.Decode64(this._infoCookieValue)}return this._infoCookieValue},readCookie:function(C){var E=C+"=";var A=document.cookie.split(";");var B=A.length;for(var D=0;D<B;D++){var F=A[D];while(F.charAt(0)==" "){F=F.substring(1,F.length)}if(F.indexOf(E)===0){return F.substring(E.length,F.length)}}return"Unknown"},get_randomNumber:function(){if(this._randomNumber.length===0){this._randomNumber=this._setRandom()+""}return this._randomNumber},get_livePreviewUrl:function(){if(this._livePreviewUrl!=null){return this._livePreviewUrl}var A=this.queryString("env");var B=this.queryString("cid");if(B!=null&&B!==""&&A!=null&A!==""){this._livePreviewUrl=unescape(A)+"?creativeId="+B;return this._livePreviewUrl}return null}};function AdCallAd(B,C){var A=/,/;if(A.test(B)){siteArr=B.split(",");this._page=siteArr[1];if(siteArr.length>2){this._queryString="&"+siteArr[2].replace(/^\s\s*/,"").replace(/\s\s*$/,"")}}this._subd=C}AdCallAd.prototype={_page:"",_pos:"",_adWidth:0,_adHeight:0,_subd:"",_friendID:0,_queryString:"",get_page:function(){return this._page},set_page:function(A){this._page=A},get_pos:function(){return this._pos},get_adWidth:function(){return this._adWidth},get_adHeight:function(){return this._adHeight},get_subd:function(){return this._subd},get_friendID:function(){return this._friendID},get_queryString:function(){return this._queryString},setAdProperties:function(G,I,B,C,H){this._pos=G;switch(G){case"frame1":this._adWidth=728;this._adHeight=90;this._pos="leaderboard";this._subd="deLB";break;case"top":this._adWidth=468;this._adHeight=60;this._pos="banner";this._subd="deBR";break;case"x08":this._adWidth=430;this._adHeight=600;this._pos="halfpage";this._subd="deHP";break;case"x14":this._adWidth=300;this._adHeight=250;this._pos="mrec";this._subd="deMR";break;case"x15":this._adWidth=160;this._adHeight=600;this._pos="skyscraper";this._subd="deSK";break;case"x77":this._adWidth=1;this._adHeight=1;this._pos="1x1";this._subd="deSB";break;case"x78":this._adWidth=750;this._adHeight=600;this._pos="interstitial";this._subd="deSB";break;case"uhpfp":this._adWidth=200;this._adHeight=170;this._subd="deFP";break;case"west":this._adWidth=440;this._adHeight=160;this._subd="deWB";break;case"east":this._adWidth=300;this._adHeight=100;this._subd="deEB";break;case"vrec":this._adWidth=240;this._adHeight=400;this._subd="deVR";break;case"slogo":this._adWidth=180;this._adHeight=32;this._subd="desb";break;case"923x250":this._adWidth=923;this._adHeight=250;this._subd="desb";break;case"ccpixel":this._adWidth=1;this._adHeight=1;this._subd="deSB";break;case"mfapp1":this._adWidth=543;this._adHeight=100;this._subd="dewb";break;case"mfapp2":this._adWidth=543;this._adHeight=100;this._subd="deeb";break;case"mfapp3":this._adWidth=543;this._adHeight=100;this._subd="defml";break;case"mfapp4":this._adWidth=350;this._adHeight=100;this._subd="defmr";break;case"540x200":this._adWidth=540;this._adHeight=200;this._subd="desb";break;case"942x250":this._adWidth=942;this._adHeight=250;this._subd="desb";break;case"620x50":this._adWidth=620;this._adHeight=50;this._subd="deeb";break;case"960x50":this._adWidth=960;this._adHeight=50;this._subd="desb";break;case"800x50":this._adWidth=800;this._adHeight=50;this._subd="desb";break;case"860x250":this._adWidth=860;this._adHeight=250;this._subd="deeb";break;case"960x250":this._adWidth=960;this._adHeight=250;this._subd="desb";break;case"960x300":this._adWidth=960;this._adHeight=300;this._subd="dewb";break;case"300x40":this._adWidth=300;this._adHeight=40;this._subd="desb";break;case"500x350":this._adWidth=500;this._adHeight=350;this._subd="desb";break;case"1x1custom":this._adWidth=1;this._adHeight=1;this._subd="deeb";break;case"50x22":this._adWidth=50;this._adHeight=22;this._subd="desb";break;case"144x40":this._adWidth=160;this._adHeight=40;this._subd="desb";break;case"hptab":this._adWidth=210;this._adHeight=330;this._subd="desb";break;case"600x90":this._adWidth=600;this._adHeight=90;this._subd="desb";break;case"930x255":this._adWidth=930;this._adHeight=255;this._subd="dewb";break;case"app1":this._adWidth=200;this._adHeight=125;this._subd="dewb";break;case"app2":this._adWidth=200;this._adHeight=125;this._subd="defmr";break;case"app3":this._adWidth=200;this._adHeight=125;this._subd="defml";break;case"620x200":this._adWidth=620;this._adHeight=200;this._subd="deeb";break;case"600x360":this._adWidth=600;this._adHeight=360;this._subd="desb";break;case"140x200":this._adWidth=140;this._adHeight=200;this._subd="dewb";break;default:this._adWidth=I;this._adHeight=B;this._pos=C;this._friendID=H;break}var A=AdHelper.readCookie("MSCulture");var F="&IPCulture=";var E=A.indexOf(F);var D=A.substring(E+F.length,A.length);if(D.indexOf("&")>=0){D=D.substring(0,D.indexOf("&"))}if(D.indexOf("ja-JP")>=0){this._subd="adjp01";switch(G){case"frame1":this._pos="leaderboard&params.styles=leaderboard";break;case"x08":this._pos="halfpage&params.styles=halfpage";break;case"x78":this._pos="interstitial&params.styles=halfpage";break;default:break}}else{if(D.indexOf("pl-PL")>=0&&G=="frame1"){this._adWidth=750;this._adHeight=100}}},addParam:function(B,A){var C=this.addParam.arguments[2];if(A!=null&&A!==""){if(C){if(!A){return false}}this._queryString+="&"+B+"="+A;return true}else{return false}}};function sdc_wrapper(){var A=sdc_wrapper.arguments;var D="";var C=/,/;if(C.test(A[1])){siteArr=A[1].split(",");D=siteArr[1]}var F=AdHelper.queryString("fuseaction");var B=AdHelper.getFunctionalContext();if((A.length===3||A[3]!==false)&&AdHelper.getDecodedURL().indexOf("vids.myspace.com")===-1&&!Advertiser.Util.IsDefined("MySpace.Ads.NoWait")&&B!=="ViewImage"&&B!=="ViewTaggedPhoto"&&B!=="Splash"&&B!=="User"&&B!=="UserViewProfile"){function E(){generateAd(A[0],A[1],A[2])}Advertiser.Util.AddEvent(window,"load",E)}else{generateAd(A[0],A[1],A[2])}}function generateAd(){var A=generateAd.arguments;var M=A[0];var F=A[1];var H=A[2].toLowerCase();if(Advertiser.SDC.AdsRendered[M]){if(!Advertiser.SDC.AllowRefresh){return}if(Advertiser.Refresher.ActiveAd===M){Advertiser.Refresher.PendingAdCalls[M]="generateAd('"+A[0]+"','"+A[1]+"','"+A[2]+"')";return}}var Q=document.getElementById(M);if(Q==null){return}var B=AdHelper.queryString("fuseaction");var L=AdHelper.getFunctionalContext();var R=new AdCallAd(F,"deLB");R.setAdProperties(H,728,90,"leaderboard&params.styles=leaderboard",AdHelper.get_friendId());if((L==="VideosIndividual"||L==="VidsChannel"||L==="VideosShowVideos")&&Advertiser.DFP.HasVideoPlayer()&&!Advertiser.DFP.HasHuluPlayer()){if(Advertiser.DFP.AdsDetermined){if(Advertiser.DFP.AdsRoadBlocked===true||Advertiser.DFP.AdsRoadBlocked==="true"){return}}else{if(!Advertiser.Util.IsDefined("Advertiser.DFP.TimeoutCounts['"+M+"']",false)){Advertiser.DFP.TimeoutCounts[M]=0}if(Advertiser.DFP.TimeoutCounts[M]<10){Advertiser.DFP.TimeoutCounts[M]++;var G="generateAd('"+A[0]+"','"+A[1]+"','"+A[2]+"')";setTimeout(G,1000);return}}}var N=AdHelper.queryString("adHeight");var E=AdHelper.queryString("adWidth");var P=AdHelper.get_livePreviewUrl();if(P!=null&&N==R.get_adHeight()&&E==R.get_adWidth()){frameURL=P}else{if(R.get_subd()==="adjp01"){ad_wrapper(M,F,A[2]);return}else{Advertiser.SDC.setTargetValues();if(L==="UserViewProfile"&&AdHelper.queryString("pe")==="1"){R.set_page("11130003")}else{if(L==="SiteSearch"){var K=AdHelper.queryString("type");if(K==="music"){R.set_page("21000002")}else{if(K==="myspacetv"){R.set_page("91000003")}else{if(K==="people"){R.set_page("19002003")}}}}}if(Advertiser.Util.IsDefined("MySpace.ClientContext.UserId")&&MySpace.ClientContext.UserId==AdHelper.get_friendId()){if(L==="ViewImage"){R.set_page("11013108")}else{if(L==="ViewTaggedPhoto"){R.set_page("11011127")}else{if(L==="UserViewAlbums"){R.set_page("11511119")}else{if(L==="UserViewPicture"){R.set_page("11513004")}else{if(L==="SitesPhotosImageDetail"){R.set_page("21700700")}else{if(L==="SitesPhotosAlbum"){R.set_page("21709400")}else{if(L==="SitesPhotosImageDetailTagged"){R.set_page("21708001")}else{if(L==="SitesPhotosLanding"){R.set_page("21706100")}}}}}}}}}if(Advertiser.Util.IsDefined("MySpace.Ads.CurtainPageValue")&&MySpace.Ads.CurtainPageValue!=""&&R.get_pos()==="mrec"){R.set_page(MySpace.Ads.CurtainPageValue);MySpace.Ads.CurtainPageValue=""}if(Advertiser.Util.IsDefined("MySpace.Ads.SiteSearchPageValue")&&MySpace.Ads.SiteSearchPageValue!=""){R.set_page(MySpace.Ads.SiteSearchPageValue)}R.addParam("l",R.get_page());R.addParam("pos",R.get_pos());R.addParam("rnd",AdHelper.get_randomNumber().substring(2,11));R.addParam("cat",AdHelper.getVar("ad_Topic_ID"),true);R.addParam("tvcat",AdHelper.getVar("tvcat"),true);R.addParam("tvch",AdHelper.getTVChannelID(),true);R.addParam("tvvid",AdHelper.getTVVideoID(),true);R.addParam("tvmcat",AdHelper.getTVCatMasterId());R.addParam("sp",AdHelper.queryString("schoolID"));R.addParam("s",AdHelper.queryString("special"));R.addParam("luc",AdHelper.getVar("sdcculture"));R.addParam("uhpt",AdHelper.getVar("uhpt"));R.addParam("nwcat",AdHelper.getVar("nwcat"));R.addParam("nwvert",AdHelper.getVar("nwvert"));R.addParam("gsku",AdHelper.getVar("gsku"));R.addParam("gcat",AdHelper.getVar("gcat"));if(L==="UserViewProfile"&&AdHelper.queryString("rmo",false)!==null){R.addParam("rmo",AdHelper.queryString("rmo",false))}if(AdHelper.getDecodedURL().indexOf("apps.myspace.com")!==-1){var D=AdHelper.queryString("category");if(D!=null&&D!=""){D="10"+D;R.addParam("dwcat",D)}}if(Advertiser.Util.IsDefined("MySpace.Ads.BandType")){R.addParam("bg1",MySpace.Ads.BandType.Genre1,true);R.addParam("bg2",MySpace.Ads.BandType.Genre2,true);R.addParam("bg3",MySpace.Ads.BandType.Genre3,true);if(MySpace.Ads.BandType.LabelType!=null){switch(MySpace.Ads.BandType.LabelType){case"Major":R.addParam("mlt","2");break;case"Indie":R.addParam("mlt","3");break;default:R.addParam("mlt","1");break}}}if(Advertiser.Util.IsDefined("MySpace.Ads.Genre")){R.addParam("bg1",MySpace.Ads.Genre,true);R.addParam("bg2",MySpace.Ads.Genre,true);R.addParam("bg3",MySpace.Ads.Genre,true)}var I=decodeURI(AdHelper._documentURL);if(L==="Splash"){if(I.indexOf("latino.myspace.com")>-1){R.addParam("luc","16")}else{if(I.indexOf("us.myspace.com")>-1){R.addParam("luc","14")}else{if(I.indexOf("jp.myspace.com")>-1){R.addParam("luc","9")}else{if(I.indexOf("kr.myspace.com")>-1){R.addParam("luc","30")}}}}}if(Advertiser.Util.IsDefined("MySpace.Ads.Account.Type")){R.addParam("acct",MySpace.Ads.Account.Type,true)}var C=Advertiser.Util.ReadCookieKey(Advertiser.GADC.CookieName,Advertiser.GADC.UserInfoKey);if(C==null){C=""}C+=Advertiser.SDC.DisplayedFriendEUD;R.addParam("ged",C);if(Advertiser.Util.IsDefined("MySpace.AdsPD")){R.addParam("ed",MySpace.AdsPD)}frameURL="http://"+R.get_subd()+".opt.fimserve.com/adopt/?r=h"+R.get_queryString()}}var O="";if(L==="PopUpPlayer"||L=="CelebrityPromo"||L=="MusicSinglePlaylist"||L=="ArtistAlbums"||L=="SiteSearch"){O="onmouseover=\"Advertiser.Refresher.SetActiveAd('"+M+'\');" onmouseout="Advertiser.Refresher.ReleaseActiveAd();"'}var J=Q.getElementsByTagName("iframe");if(J==null||typeof(J)=="undefined"||J.length<1){Q.innerHTML='<IFRAME width="'+R.get_adWidth()+'" height="'+R.get_adHeight()+'" style="position:relative;z-index:10000" MARGINWIDTH=0 MARGINHEIGHT=0 HSPACE=0 VSPACE=0 FRAMEBORDER=0 SCROLLING=no allowTransparency=true src=\''+frameURL+"' "+O+"></iframe>"}else{J[0].src=frameURL;J[0].width=R.get_adWidth();J[0].height=R.get_adHeight()}Advertiser.SDC.AdsRendered[M]=true}function ad_wrapper(){var B=ad_wrapper.arguments;var K=B[0];var F=B[1];var H=B[2].toLowerCase();if(Advertiser.SDC.AdsRendered[K]){if(!Advertiser.SDC.AllowRefresh){return}if(Advertiser.Refresher.ActiveAd===K){Advertiser.Refresher.PendingAdCalls[K]="generateAd('"+B[0]+"','"+B[1]+"','"+B[2]+"')";return}}var Q=document.getElementById(K);if(Q==null){return}var R=new AdCallAd(F,"deSB");R.setAdProperties(H,468,60,"test","0");var A="";var L=AdHelper.queryString("adHeight");var E=AdHelper.queryString("adWidth");var P=AdHelper.get_livePreviewUrl();var C=AdHelper.queryString("fuseaction");var J=AdHelper.getFunctionalContext();if(P!=null&&L==R.get_adHeight()&&E==R.get_adWidth()){A=P}else{if((J==="VideosIndividual"||J==="VidsChannel"||J==="VideosShowVideos")&&Advertiser.DFP.HasVideoPlayer()&&!Advertiser.DFP.HasHuluPlayer()){if(Advertiser.DFP.AdsDetermined){if(Advertiser.DFP.AdsRoadBlocked===true||Advertiser.DFP.AdsRoadBlocked==="true"){return}}else{if(!Advertiser.Util.IsDefined("Advertiser.DFP.TimeoutCounts['"+K+"']",false)){Advertiser.DFP.TimeoutCounts[K]=0}if(Advertiser.DFP.TimeoutCounts[K]<10){Advertiser.DFP.TimeoutCounts[K]++;var G="ad_wrapper('"+B[0]+"','"+B[1]+"','"+B[2]+"')";setTimeout(G,1000);return}}}Advertiser.SDC.setTargetValues();R.addParam("page",R.get_page());R.addParam("position",R.get_pos());R.addParam("rand",AdHelper.get_randomNumber().substring(2,11));R.addParam("category",AdHelper.getVar("ad_Topic_ID"),true);R.addParam("acnt",AdHelper.get_adCount());R.addParam("channelid",AdHelper.getVarOrId("ad_Video_CID","channelid"),true);R.addParam("tvvideoid",AdHelper.getTVVideoID(),true);R.addParam("tvcategoryid",AdHelper.getVar("tvcat"),true);R.addParam("tvchannelid",AdHelper.getTVChannelID(),true);R.addParam("tvmastercategory",AdHelper.getTVCatMasterId());R.addParam("uhpt",AdHelper.getVar("uhpt"));R.addParam("nwcat",AdHelper.getVar("nwcat"));R.addParam("nwvert",AdHelper.getVar("nwvert"));if(AdHelper.getDecodedURL().indexOf("apps.myspace.com")!==-1){var D=AdHelper.queryString("category");if(D!=null&&D!=""){D="10"+D;R.addParam("dwcat",D)}}var N=R.addParam("schoolpage",AdHelper.queryString("schoolID"));if(!N){R.addParam("schoolpage","0")}if(Advertiser.Util.IsDefined("MySpace.Ads.BandType")){R.addParam("bg1",MySpace.Ads.BandType.Genre1,true);R.addParam("bg2",MySpace.Ads.BandType.Genre2,true);R.addParam("bg3",MySpace.Ads.BandType.Genre3,true);if(MySpace.Ads.BandType.LabelType!=null){switch(MySpace.Ads.BandType.LabelType){case"Major":R.addParam("mlt","2");break;case"Indie":R.addParam("mlt","3");break;default:R.addParam("mlt","1");break}}}if(Advertiser.Util.IsDefined("MySpace.Ads.Genre")){R.addParam("bg1",MySpace.Ads.Genre,true);R.addParam("bg2",MySpace.Ads.Genre,true);R.addParam("bg3",MySpace.Ads.Genre,true)}if(Advertiser.Util.IsDefined("MySpace.Ads.Account.Type")){R.addParam("acct",MySpace.Ads.Account.Type,true)}var M=R.addParam("special",AdHelper.queryString("special"));if(M){A="http://detst.myspace.com/html.ng/site=myspace"+R.get_queryString()}else{A="http://"+R.get_subd()+".myspace.com/html.ng/site=myspace"+R.get_queryString()}}var O="";if(J==="PopUpPlayer"||J=="CelebrityPromo"){O="onmouseover=\"Advertiser.Refresher.SetActiveAd('"+K+'\');" onmouseout="Advertiser.Refresher.ReleaseActiveAd();"'}var I=Q.getElementsByTagName("iframe");if(I==null||typeof(I)=="undefined"||I.length<1){Q.innerHTML='<IFRAME width="'+R.get_adWidth()+'" height="'+R.get_adHeight()+'" style="position:relative;z-index:10000" MARGINWIDTH=0 MARGINHEIGHT=0 HSPACE=0 VSPACE=0 FRAMEBORDER=0 SCROLLING=no allowTransparency=true src=\''+A+"' "+O+"></iframe>"}else{I[0].src=A;I[0].width=R.get_adWidth();I[0].height=R.get_adHeight()}AdHelper.incrementAdCount();Advertiser.SDC.AdsRendered[K]=true}function sdc_wrapper_medrec_delay(){var A=sdc_wrapper_medrec_delay.arguments;if(A==null||A.length!==3){return}var B=document.getElementById(A[0]);if(B==null){return}B.style.height=250;var C="generateAd('"+A[0]+"','"+A[1]+"','"+A[2]+"')";setTimeout(C,1000)}function ad_wrapper_medrec_delay(){var A=ad_wrapper_medrec_delay.arguments;if(A==null||A.length!==3){return}var B=document.getElementById(A[0]);if(B==null){return}B.style.height=250;var C="ad_wrapper('"+A[0]+"','"+A[1]+"','"+A[2]+"')";setTimeout(C,1000)}function sdc_wrapper_refresh(){var B=sdc_wrapper_refresh.arguments;if(B===null||B.length!==4){return}var D=B[0];var C=document.getElementById(D);if(C===null){return}var A=B[3]*1000;if(A>0){Advertiser.Refresher.AddFocusEvents();var E=new Object;E.Delay=A;E.AdCall="generateAd('"+D+"','"+B[1]+"','"+B[2]+"')";Advertiser.Refresher.AutoList[D]=E;Advertiser.Refresher.AutoRefreshAd(D)}}function sdc_wrapper_delay_refresh(){var B=sdc_wrapper_delay_refresh.arguments;if(B==null||B.length!=5){return}var E=B[0];var C=document.getElementById(E);if(C==null){return}var A=B[4]*1000;if(isNaN(A)){A=3000}Advertiser.Refresher.AddFocusEvents();var D="sdc_wrapper_refresh('"+E+"','"+B[1]+"','"+B[2]+"','"+B[3]+"')";setTimeout(D,A)}function syncRoadBlock(A){a=A.split(";");if(a.length>0){for(x=0;x<a.length;x++){if(a[x].indexOf("sz=")==0){size=a[x].substring(3);dims=size.split("x");width=dims[0];height=dims[1];if(height==90){Advertiser.DFP.LoadRoadBlock("tkn_leaderboard",width,height,A)}else{if(height==250){Advertiser.DFP.LoadRoadBlock("tkn_medrec",width,height,A)}}}}}};