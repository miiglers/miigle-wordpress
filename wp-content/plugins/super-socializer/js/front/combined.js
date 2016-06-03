theChampFBKey = typeof theChampFBKey != 'undefined' ? theChampFBKey : '', theChampFBLang = typeof theChampFBLang != 'undefined' ? theChampFBLang : '';
// general.js
function theChampPopup(e){window.open(e,"popUpWindow","height=400,width=600,left=400,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes")}function theChampStrReplace(e,t,n){for(var r=0;r<e.length;r++){n=n.replace(new RegExp(e[r],"g"),t[r])}return n}function theChampCallAjax(e){if(typeof jQuery!="undefined"){e()}else{theChampGetScript("http://code.jquery.com/jquery-latest.min.js",e)}}function theChampGetScript(e,t){var n=document.createElement("script");n.src=e;var r=document.getElementsByTagName("head")[0],i=false;n.onload=n.onreadystatechange=function(){if(!i&&(!this.readyState||this.readyState=="loaded"||this.readyState=="complete")){i=true;t();n.onload=n.onreadystatechange=null;r.removeChild(n)}};r.appendChild(n)}function theChampGetElementsByClass(e,t){if(e.getElementsByClassName){return e.getElementsByClassName(t)}else{return function(e,t){if(t==null){t=document}var n=[],r=t.getElementsByTagName("*"),i=r.length,s=new RegExp("(^|\\s)"+e+"(\\s|$)"),o,u;for(o=0,u=0;o<i;o++){if(s.test(r[o].className)){n[u]=r[o];u++}}return n}(t,e)}}if(typeof String.prototype.trim!=="function"){String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g,"")}}
// common.js
function theChampLoadingIcon(){jQuery(".the_champ_login_container").html('<img id="the_champ_loading_image" src="'+theChampLoadingImgPath+'" />')}function theChampAjaxUserAuth(e,t){theChampLoadingIcon(),jQuery.ajax({type:"POST",dataType:"json",url:theChampAjaxUrl,data:{action:"the_champ_user_auth",profileData:e,provider:t,redirectionUrl:theChampTwitterRedirect?theChampTwitterRedirect:""},success:function(e){var t=theChampSiteUrl;if(1==e.status)t="register"==e.message?e.url&&""!=e.url?e.url:theChampRegRedirectionUrl+(theChampCommentFormLogin?"/#commentform":""):"linked"==e.message?theChampLinkingRedirection+"?linked=1":e.url&&""!=e.url?e.url:theChampRedirectionUrl+(theChampCommentFormLogin?"/#commentform":"");else if(null!==e.message.match(/ask/)){var a=e.message.split("|");t=theChampSiteUrl+"?SuperSocializerEmail=1&par="+a[1]}else 0==e.status&&"registration disabled"==e.message?t="undefined"!=typeof theChampDisableRegRedirect?theChampDisableRegRedirect:decodeURIComponent(theChampTwitterRedirect):"unverified"==e.message?t=theChampSiteUrl+"?SuperSocializerUnverified=1":"not linked"==e.message?t=theChampLinkingRedirection+"?linked=0":"provider exists"==e.message&&(t=theChampLinkingRedirection+"?linked=2");location.href=t},error:function(){location.href=decodeURIComponent(theChampRedirectionUrl)}})}function theChampInitiateLogin(e){var t=e.getAttribute("alt");if("Login with Facebook"==t)navigator.userAgent.match("CriOS")?location.href="https://www.facebook.com/dialog/oauth?client_id="+theChampFBKey+"&redirect_uri="+theChampRedirectionUrl+"&scope="+theChampFacebookScope:theChampAuthUserFB();else if("Login with Twitch"==t)theChampPopup(theChampSiteUrl+"?SuperSocializerAuth=Twitch");else if("Login with Steam"==t)theChampPopup(theChampSteamAuthUrl);else if("Login with Twitter"==t)theChampPopup(theChampSiteUrl+"?SuperSocializerAuth=Twitter&super_socializer_redirect_to="+theChampTwitterRedirect);else if("Login with Xing"==t)theChampPopup(theChampSiteUrl+"?SuperSocializerAuth=Xing&super_socializer_redirect_to="+theChampTwitterRedirect);else{if("Login with Linkedin"==t)return IN.User.authorize(),!1;"Login with Google"==t?theChampInitializeGPLogin():"Login with Vkontakte"==t?theChampInitializeVKLogin():"Login with Instagram"==t&&theChampInitializeInstaLogin()}}function theChampDisplayLoginIcon(e,t){if("undefined"!=typeof jQuery)for(var a=0;a<t.length;a++)jQuery("."+t[a]).css("display","block");else for(var a=0;a<t.length;a++)for(var i=theChampGetElementsByClass(e,t[a]),h=0;h<i.length;h++)i[h].style.display="block"}function theChampValidateEmail(e){var t=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;return t.test(e)}function the_champ_save_email(e){var t=document.getElementById("the_champ_email").value.trim(),a=document.getElementById("the_champ_confirm_email").value.trim();return"save"!=e.id||theChampValidateEmail(t)?t!=a?(document.getElementById("the_champ_error").innerHTML="Email addresses do not match",void jQuery("#TB_ajaxContent").css("height","auto")):void theChampCallAjax(function(){theChampSaveEmail(e.id,t)}):(document.getElementById("the_champ_error").innerHTML=theChampEmailPopupErrorMsg,void jQuery("#TB_ajaxContent").css("height","auto"))}function theChampSaveEmail(e,t){document.getElementById("the_champ_error").innerHTML='<img src="'+theChampLoadingImgPath+'" />',jQuery.ajax({type:"POST",dataType:"json",url:theChampAjaxUrl,data:{action:"the_champ_save_email",elemId:e,email:t,id:theChampEmailPopupUniqueId},success:function(e){window.history.pushState({html:"html",pageTitle:"page title"},"","?done=1"),1==e.status&&e.message.response&&"success"==e.message.response?location.href=e.message.url:1==e.status&&"success"==e.message?location.href=theChampRegRedirectionUrl:1==e.status&&"cancelled"==e.message?tb_remove():1==e.status&&"verify"==e.message?document.getElementById("TB_ajaxContent").innerHTML="<strong>"+theChampEmailPopupVerifyMessage+"</strong>":0==e.status&&(document.getElementById("the_champ_error").innerHTML=e.message,jQuery("#TB_ajaxContent").css("height","auto"))},error:function(){location.href=decodeURIComponent(theChampRedirectionUrl)}})}function theChampCapitaliseFirstLetter2(e){return e.charAt(0).toUpperCase()+e.slice(1)}theChampVerified&&theChampLoadEvent(function(){tb_show(theChampPopupTitle,theChampAjaxUrl)}),theChampEmailPopup&&theChampLoadEvent(function(){tb_show(theChampEmailPopupTitle,theChampEmailAjaxUrl)});var theChampCommentFormLogin=!1;
// Google.js
function theChampGoogleOnLoad(){theChampDisplayLoginIcon(document,["theChampGoogleButton","theChampGoogleLogin"])}function theChampInitializeGPLogin(){gapi.auth.signIn({callback:theChampGPSignInCallback,clientid:theChampGoogleKey,cookiepolicy:"single_host_origin",scope:"profile email"})}function theChampGPSignInCallback(e){e.status.signed_in?gapi.client.load("plus","v1",function(){e.access_token?theChampGetProfile():''}):''}function theChampGetProfile(){theChampLoadingIcon();var e=gapi.client.plus.people.get({userId:"me"});e.execute(function(e){return e.error?void("Access Not Configured. Please use Google Developers Console to activate the API for your project."==e.message&&(alert(theChampGoogleErrorMessage),window.open("http://support.heateor.com/how-to-get-google-plus-client-id/"))):void(e.id&&theChampCallAjax(function(){theChampAjaxUserAuth(e,"google")}))})}!function(){var e=document.createElement("script");e.type="text/javascript",e.async=!0,e.src="https://apis.google.com/js/client:platform.js?onload=theChampGoogleOnLoad";var o=document.getElementsByTagName("script")[0];o.parentNode.insertBefore(e,o)}();
// linkedin.js
function theChampLinkedInOnLoad(){theChampDisplayLoginIcon(document,["theChampLinkedinButton", "theChampLinkedinLogin"])}typeof IN!="undefined"&&IN.Event.on(IN,"auth",function(){theChampLoadingIcon();IN.API.Profile("me").fields(["email-address","id","picture-urls::(original)","first-name","last-name","headline","picture-url","public-profile-url"]).result(function(e){if(e.values[0].id&&e.values[0].id!=""){theChampCallAjax(function(){theChampAjaxUserAuth(e.values[0],"linkedin")})}})})
// vkontakte.js
function theChampInitializeVKLogin(){VK.Auth.login(function(t){t.session.mid&&VK.Api.call("getProfiles",{uids:t.session.mid,fields:"uid, first_name, last_name, nickname, photo, photo_big"},function(t){t.response[0].uid&&theChampCallAjax(function(){theChampAjaxUserAuth(t.response[0],"vkontakte")})})})}if(typeof theChampVkKey!="undefined"){window.vkAsyncInit=function(){VK.init({apiId:theChampVkKey}),theChampDisplayLoginIcon(document,["theChampVkontakteButton","theChampVkontakteLogin"])},setTimeout(function(){var t=document.getElementsByTagName("head")[0],e=document.createElement("script");e.type="text/javascript",e.src="//vk.com/js/api/openapi.js",e.async=!0,t.appendChild(e)},0);}
// instagram.js
function theChampInitializeInstaLogin(){var e=typeof theChampLinkingRedirection!="undefined"&&theChampLinkingRedirection!=""?theChampLinkingRedirection:theChampTwitterRedirect;theChampPopup("https://instagram.com/oauth/authorize/?client_id="+theChampInstaId+"&redirect_uri="+encodeURI(theChampSiteUrl+"?ssredirect="+e)+"&response_type=token")}function theChampGetHashValue(e){if(typeof e!=="string"){e=""}else{e=e.toLowerCase()}var t=location.hash.toLowerCase().match(new RegExp(e+"=([^&]*)"));var n="";if(t){n=t[1]}return n}function theChampGetParameterByName(e){e=e.replace(/[\[]/,"\\[").replace(/[\]]/,"\\]");var t=new RegExp("[\\?&]"+e+"=([^&#]*)"),n=t.exec(location.search);return n===null?"":decodeURIComponent(n[1].replace(/\+/g," "))}var theChampInstagramHash=theChampGetHashValue("access_token");if(theChampInstagramHash!=""){var redirection=theChampGetParameterByName("ssredirect");window.opener.location.href=theChampSiteUrl+"?SuperSocializerInstaToken="+theChampInstagramHash+"&super_socializer_redirect_to="+(redirection?redirection:theChampTwitterRedirect);window.close()}
// sdk.js
function theChampInitiateFB(){FB.init({appId:theChampFBKey,channelUrl:"//"+theChampSiteUrl+"/channel.html",status:!0,cookie:!0,xfbml:!0,version:"v2.5"})}window.fbAsyncInit=function(){theChampInitiateFB(),theChampFbIosLogin&&theChampAuthUserFB(),"function"==typeof theChampDisplayLoginIcon&&theChampDisplayLoginIcon(document,["theChampFacebookButton","theChampFacebookLogin"]),theChampCommentNotification&&FB.Event.subscribe("comment.create",function(e){e.commentID&&jQuery.ajax({type:"POST",dataType:"json",url:theChampSiteUrl+"/index.php",data:{action:"the_champ_moderate_fb_comments",data:e},success:function(){}})}),theChampFbLikeMycred&&(FB.Event.subscribe("edge.create",function(e){heateorSsmiMycredPoints("Facebook_like_recommend","",e?e:"")}),FB.Event.subscribe("edge.remove",function(e){heateorSsmiMycredPoints("Facebook_like_recommend","",e?e:"","Minus point(s) for undoing Facebook like-recommend")})),theChampSsga&&(FB.Event.subscribe("edge.create",function(e){heateorSsgaSocialPluginsTracking("Facebook","Like",e?e:"")}),FB.Event.subscribe("edge.remove",function(e){heateorSsgaSocialPluginsTracking("Facebook","Unlike",e?e:"")}))},function(e){var t,n="facebook-jssdk",o=e.getElementsByTagName("script")[0];e.getElementById(n)||(t=e.createElement("script"),t.id=n,t.async=!0,t.src="//connect.facebook.net/"+theChampFBLang+"/sdk.js",o.parentNode.insertBefore(t,o))}(document);
// facebook.js
function theChampAuthUserFB(){FB.getLoginStatus(theChampFBCheckLoginStatus)}function theChampFBCheckLoginStatus(response){if(response&&response.status=='connected'){theChampLoadingIcon();theChampFBLoginUser()}else{FB.login(theChampFBLoginUser,{scope:theChampFacebookScope})}}function theChampFBLoginUser(){FB.api('/me?fields=id,name,bio,about,link,email,first_name,last_name',function(response){if(!response.id){return}theChampCallAjax(function(){theChampAjaxUserAuth(response,'facebook')})})}
// commenting.js
function theChampRenderFBCommenting(){var e='';if(typeof theChampCommentingId != 'undefined'){e=document.getElementById(theChampCommentingId);}if(e){var t=[],a=[],m=[];t.wordpress='<div style="clear:both"></div>'+e.innerHTML,theChampFBCommentingContent='<div class="fb-comments" data-href="'+theChampFBCommentUrl+'"',""!=theChampFBCommentColor&&(theChampFBCommentingContent+=' data-colorscheme="'+theChampFBCommentColor+'"'),""!=theChampFBCommentNumPosts&&(theChampFBCommentingContent+=' data-numposts="'+theChampFBCommentNumPosts+'"'),theChampFBCommentingContent+=' data-width="'+theChampFBCommentWidth+'"',""!=theChampFBCommentOrderby&&(theChampFBCommentingContent+=' data-order-by="'+theChampFBCommentOrderby+'"'),theChampFBCommentingContent+=" ></div>",t.fb=theChampFBCommentingContent,a.fb="theChampInitiateFB();",t.googleplus="<div class='g-comments' data-href='"+theChampGpCommentsUrl+"' "+(theChampGpCommentsWidth?"data-width='"+theChampGpCommentsWidth+"'":"")+" data-first_party_property='BLOGGER' data-view_type='FILTERED_POSTMOD' ></div>",a.googleplus=" ",m.googleplus="//apis.google.com/js/plusone.js",t.disqus='<div class="embed-container clearfix" id="disqus_thread">'+(""!=theChampDisqusShortname?theChampDisqusShortname:'<div style="font-size: 14px;clear: both;">Specify a Disqus shortname in Super Socializer &gt; Social Commenting section in admin panel</div>')+"</div>",a.disqus="var disqus_shortname = '"+theChampDisqusShortname+"';(function(d) {var dsq = d.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js'; (d.getElementsByTagName('head')[0] || d.getElementsByTagName('body')[0]).appendChild(dsq); })(document);";var h='<div class="theChampCommentingTabs"><h3 id="theChampReplyTitle" style="margin-bottom:15px" class="comment-reply-title">'+theChampScLabel+"</h3><ul>";theChampScEnabledTabs=theChampScEnabledTabs.split(",");for(var n=0;n<theChampScEnabledTabs.length;n++){h+='<li id="theChampTabs-'+n+'-li" onclick="',h+="this.setAttribute('class', 'theChampSelectedTab');document.getElementById('theChampTabs-"+n+"').style.display='block';","fb"==theChampScEnabledTabs[n]&&(h+="theChampInitiateFB();");for(var s=0;s<theChampScEnabledTabs.length;s++)s!=n&&(h+="document.getElementById('theChampTabs-"+s+"-li').setAttribute('class', '');document.getElementById('theChampTabs-"+s+"').style.display='none';");h+='">',h+=theChampScTabLabels[theChampScEnabledTabs[n]],h+="</li>"}h+="</ul>";for(var n=0;n<theChampScEnabledTabs.length;n++)h+='<div id="theChampTabs-'+n+'" ><div style="clear: both"></div>'+t[theChampScEnabledTabs[n]]+"</div>";h+="</div>",e.innerHTML=h;var d=document.getElementById("reply-title");d&&d.remove();for(var n=0;n<theChampScEnabledTabs.length;n++)if(a[theChampScEnabledTabs[n]]){var o=document.createElement("script");m[theChampScEnabledTabs[n]]&&o.setAttribute("src",m[theChampScEnabledTabs[n]]),o.innerHTML=a[theChampScEnabledTabs[n]],document.getElementById("theChampTabs-"+n).appendChild(o)}document.getElementById("theChampTabs-0-li").setAttribute("class","theChampSelectedTab");for(var n=1;n<theChampScEnabledTabs.length;n++)document.getElementById("theChampTabs-"+n).style.display="none"}}theChampLoadEvent(function(){theChampRenderFBCommenting()});
// sharing.js
/**
 * Show more sharing services popup
 */
function theChampMoreSharingPopup(elem, postUrl, postTitle){
	concate = '</ul></div><div class="footer-panel"><p></p></div></div>';
	var theChampMoreSharingServices = {
	  facebook: {
		title: "Facebook",
		locale: "en-US",
		redirect_url: "http://www.facebook.com/sharer.php?u=" + postUrl + "&t=" + postTitle + "&v=3",
	  },
	  twitter: {
		title: "Twitter",
		locale: "en-US",
		redirect_url: "http://twitter.com/intent/tweet?text=" + postTitle + " " + postUrl,
	  },
	  google: {
		title: "Google plus",
		locale: "en-US",
		redirect_url: "https://plus.google.com/share?url=" + postUrl,
	  },
	  linkedin: {
		title: "Linkedin",
		locale: "en-US",
		redirect_url: "http://www.linkedin.com/shareArticle?mini=true&url=" + postUrl + "&title=" + postTitle,
	  },
	  pinterest: {
		title: "Pinterest",
		locale: "en-US",
		redirect_url: "https://pinterest.com/pin/create/button/?url=" + postUrl + "&media=${media_link}&description=" + postTitle,
		bookmarklet_url: "javascript:void((function(){var e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','//assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)})());"
	  },
	  yahoo_bookmarks: {
		title: "Yahoo",
		locale: "en-US",
		redirect_url: "http://bookmarks.yahoo.com/toolbar/savebm?u=" + postUrl + "&t=" + postTitle,
	  },
	  email: {
		title: "Email",
		locale: "en-US",
		redirect_url: "mailto:?subject=" + postTitle + "&body=Link: " + postUrl,
	  },
	  delicious: {
		title: "Delicious",
		locale: "en-US",
		redirect_url: "http://delicious.com/save?url=" + postUrl + "&title=" + postTitle,
	  },
	  reddit: {
		title: "Reddit",
		locale: "en-US",
		redirect_url: "http://reddit.com/submit?url=" + postUrl + "&title=" + postTitle,
	  },
	  float_it: {
		title: "Float it",
		locale: "en-US",
		redirect_url: "http://www.designfloat.com/submit.php?url=" + postUrl + "&title=" + postTitle,
	  },
	  google_mail: {
		title: "Google Gmail",
		locale: "en-US",
		redirect_url: "https://mail.google.com/mail/?ui=2&view=cm&fs=1&tf=1&su=" + postTitle + "&body=Link: " + postUrl,
	  },
	  google_bookmarks: {
		title: "Google Bookmarks",
		locale: "en-US",
		redirect_url: "http://www.google.com/bookmarks/mark?op=edit&bkmk=" + postUrl + "&title=" + postTitle,
	  },
	  digg: {
		title: "Digg",
		locale: "en-US",
		redirect_url: "http://digg.com/submit?phase=2&url=" + postUrl + "&title=" + postTitle,
	  },
	  stumbleupon: {
		title: "Stumbleupon",
		locale: "en-US",
		redirect_url: "http://www.stumbleupon.com/submit?url=" + postUrl + "&title=" + postTitle,
	  },
	  printfriendly: {
		title: "PrintFriendly",
		locale: "en-US",
		redirect_url: "http://www.printfriendly.com/print?url=" + postUrl,
	  },
	  print: {
		title: "Print",
		locale: "en-US",
		redirect_url: "http://www.printfriendly.com/print?url=" + postUrl,
	  },
	  tumblr: {
		title: "Tumblr",
		locale: "en-US",
		redirect_url: "http://www.tumblr.com/share?v=3&u=" + postUrl + "&t=" + postTitle,
		bookmarklet_url: "javascript:var d=document,w=window,e=w.getSelection,k=d.getSelection,x=d.selection,s=(e?e():(k)?k():(x?x.createRange().text:0)),f='http://www.tumblr.com/share',l=d.location,e=encodeURIComponent,p='?v=3&u='+e(l.href) +'&t='+e(d.title) +'&s='+e(s),u=f+p;try{if(!/^(.*\\.)?tumblr[^.]*$/.test(l.host))throw(0);tstbklt();}catch(z){a =function(){if(!w.open(u,'t','toolbar=0,resizable=0,status=1,width=450,height=430'))l.href=u;};if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else a();}void(0);"
	  },
	  vk: {
		title: "Vkontakte",
		locale: "ru",
		redirect_url: "https://vk.com/share.php?url=" + postUrl + "&title=" + postTitle,
	  },
	  evernote: {
		title: "Evernote",
		locale: "en-US",
		redirect_url: "https://www.evernote.com/clip.action?url=" + postUrl + "&title=" + postTitle,
		bookmarklet_url: "javascript:(function(){EN_CLIP_HOST='http://www.evernote.com';try{var x=document.createElement('SCRIPT');x.type='text/javascript';x.src=EN_CLIP_HOST+'/public/bookmarkClipper.js?'+(new Date().getTime()/100000);document.getElementsByTagName('head')[0].appendChild(x);}catch(e){location.href=EN_CLIP_HOST+'/clip.action?url='+encodeURIComponent(location.href)+'&title='+encodeURIComponent(document.title);}})();"
	  },
	  amazon_us_wish_list: {
		title: "Amazon Wish List",
		locale: "en-US",
		redirect_url: "http://www.amazon.com/wishlist/add?u=" + postUrl + "&t=" + postTitle,
		bookmarklet_url: "javascript:(function(){var w=window,l=w.location,d=w.document,s=d.createElement('script'),e=encodeURIComponent,x='undefined',u='http://www.amazon.com/gp/wishlist/add';if(typeof s!='object')l.href=u+'?u='+e(l)+'&t='+e(d.title);function g(){if(d.readyState&&d.readyState!='complete'){setTimeout(g,200);}else{if(typeof AUWLBook==x)s.setAttribute('src',u+'.js?loc='+e(l)),d.body.appendChild(s);function f(){(typeof AUWLBook==x)?setTimeout(f,200):AUWLBook.showPopover();}f();}}g();}())"
	  },
	  wordpress_blog: {
		title: "WordPress",
		locale: "en-US",
		redirect_url: "http://www.addtoany.com/ext/wordpress/press_this?linkurl=" + postUrl + "&linkname=" + postTitle,
	  },
	  whatsapp: {
		title: "Whatsapp",
		locale: "en-US",
		redirect_url: "whatsapp://send?text=" + postTitle + " " + postUrl,
	  },
	  diigo: {
		title: "Diigo",
		locale: "en-US",
		redirect_url: "http://www.diigo.com/post?url=" + postUrl + "&title=" + postTitle,
	  },
	  yc_hacker_news: {
		title: "Hacker News",
		locale: "en-US",
		redirect_url: "http://news.ycombinator.com/submitlink?u=" + postUrl + "&t=" + postTitle,
	  },
	  box_net: {
		title: "Box.net",
		locale: "en-US",
		redirect_url: "https://www.box.net/api/1.0/import?url=" + postUrl + "&name=" + postTitle + "&import_as=link",
	  },
	  aol_mail: {
		title: "AOL Mail",
		locale: "en-US",
		redirect_url: "http://webmail.aol.com/25045/aol/en-us/Mail/compose-message.aspx?subject=" + postTitle + "&body=" + postUrl,
	  },
	  yahoo_mail: {
		title: "Yahoo Mail",
		locale: "en-US",
		redirect_url: "http://compose.mail.yahoo.com/?Subject=" + postTitle + "&body=Link: " + postUrl,
	  },
	  instapaper: {
		title: "Instapaper",
		locale: "en-US",
		redirect_url: "http://www.instapaper.com/edit?url=" + postUrl + "&title=" + postTitle,
	  },
	  plurk: {
		title: "Plurk",
		locale: "en-US",
		redirect_url: "http://www.plurk.com/m?content=" + postUrl + "&qualifier=shares",
	  },
	  wanelo: {
		title: "Wanelo",
		locale: "en-US",
		redirect_url: "http://wanelo.com/p/post?bookmarklet=&images%5B%5D=&url=" + postUrl + "&title=" + postTitle + "&price=&shop=",
		bookmarklet_url: "javascript:void ((function(url){if(!window.waneloBookmarklet){var productURL=encodeURIComponent(url),cacheBuster=Math.floor(Math.random()*1e3),element=document.createElement('script');element.setAttribute('src','//wanelo.com/bookmarklet/3/setup?*='+cacheBuster+'&url='+productURL),element.onload=init,element.setAttribute('type','text/javascript'),document.getElementsByTagName('head')[0].appendChild(element)}else init();function init(){window.waneloBookmarklet()}})(window.location.href))"
	  },
	  aim: {
		title: "AIM",
		locale: "en-US",
		redirect_url: "http://share.aim.com/share/?url=" + postUrl + "&title=" + postTitle,
	  },
	  stumpedia: {
		title: "Stumpedia",
		locale: "en-US",
		redirect_url: "http://www.stumpedia.com/submit?url=" + postUrl + "&title=" + postTitle,
	  },
	  viadeo: {
		title: "Viadeo",
		locale: "en-US",
		redirect_url: "http://www.viadeo.com/shareit/share/?url=" + postUrl + "&title=" + postTitle,
	  },
	  yahoo_messenger: {
		title: "Yahoo Messenger",
		locale: "en-US",
		redirect_url: "ymsgr:sendim?m=" + postUrl,
	  },
	  pinboard_in: {
		title: "Pinboard",
		locale: "en-US",
		redirect_url: "http://pinboard.in/add?url=" + postUrl + "&title=" + postTitle,
	  },
	  blogger_post: {
		title: "Blogger Post",
		locale: "en-US",
		redirect_url: "http://www.blogger.com/blog_this.pyra?t=&u=" + postUrl + "&l&n=" + postTitle,
	  },
	  typepad_post: {
		title: "TypePad Post",
		locale: "en-US",
		redirect_url: "http://www.typepad.com/services/quickpost/post?v=2&qp_show=ac&qp_title=" + postTitle + "&qp_href=" + postUrl + "&qp_text=" + postTitle,
	  },
	  buffer: {
		title: "Buffer",
		locale: "en-US",
		redirect_url: "http://bufferapp.com/add?url=" + postUrl + "&text=" + postTitle,
	  },
	  flipboard: {
		title: "Flipboard",
		locale: "en-US",
		redirect_url: "https://share.flipboard.com/flipit/load?v=1.0&url=" + postUrl + "&title=" + postTitle,
	  },
	  mail: {
		title: "Email",
		locale: "en-US",
		redirect_url: "mailto:?subject=" + postTitle + "&body=Link: " + postUrl,
	  },
	  pocket: {
		title: "Pocket",
		locale: "en-US",
		redirect_url: "https://readitlaterlist.com/save?url=" + postUrl + "&title=" + postTitle,
	  },
	  fark: {
		title: "Fark",
		locale: "en-US",
		redirect_url: "http://cgi.fark.com/cgi/fark/submit.pl?new_url=" + postUrl,
	  },
	  yummly: {
		title: "Yummly",
		locale: "en-US",
		redirect_url: "http://www.yummly.com/urb/verify?url=" + postUrl + "&title=" + postTitle,
	  },
	  app_net: {
		title: "App.net",
		locale: "en-US",
		redirect_url: "https://account.app.net/login/",
	  },
	  baidu: {
		title: "Baidu",
		locale: "en-US",
		redirect_url: "http://cang.baidu.com/do/add?it=" + postTitle + "&iu=" + postUrl,
	  },
	  balatarin: {
		title: "Balatarin",
		locale: "en-US",
		redirect_url: "https://www.balatarin.com/login",
	  },
	  bibSonomy: {
		title: "BibSonomy",
		locale: "en-US",
		redirect_url: "http://www.bibsonomy.org/login",
	  },
	  Bitty_Browser: {
		title: "Bitty Browser",
		locale: "en-US",
		redirect_url: "http://www.bitty.com/manual/?contenttype=&contentvalue=" + postUrl,
	  },
	  Blinklist: {
		title: "Blinklist",
		locale: "en-US",
		redirect_url: "http://blinklist.com/blink?t=" + postTitle + "&d=&u=" + postUrl,
	  },
	  BlogMarks: {
		title: "BlogMarks",
		locale: "en-US",
		redirect_url: "http://blogmarks.net/my/new.php?mini=1&simple=1&title=" + postTitle + "&url=" + postUrl,
	  },
	  Bookmarks_fr: {
		title: "Bookmarks.fr",
		locale: "en-US",
		redirect_url: "http://www.bookmarks.fr/Connexion/?action=add&address=" + postUrl + "&title=" + postTitle,
	  },
	  BuddyMarks: {
		title: "BuddyMarks",
		locale: "en-US",
		redirect_url: "http://buddymarks.com/login.php?bookmark_title=" + postTitle + "&bookmark_url=" + postUrl + "&bookmark_desc=&bookmark_tags=",
	  },
	  Care2_news: {
		title: "Care2 News",
		locale: "en-US",
		redirect_url: "http://www.care2.com/passport/login.html?promoID=10&pg=http://www.care2.com/news/compose?sharehint=news&share[share_type]news&bookmarklet=Y&share[title]=" + postTitle + "&share[link_url]=" + postUrl + "&share[content]=",
	  },
	  CiteULike: {
		title: "Cite U Like",
		locale: "en-US",
		redirect_url: "http://www.citeulike.org/posturl?url=" + postUrl + "&title=" + postTitle,
	  },
	  Diary_Ru: {
		title: "Diary.Ru",
		locale: "en-US",
		redirect_url: "http://www.diary.ru/?newpost&title=" + postTitle + "&text=" + postUrl,
	  },
	  diHITT: {
		title: "diHITT",
		locale: "en-US",
		redirect_url: "http://www.dihitt.com/submit?url=" + postUrl + "&title=" + postTitle,
	  },
	  dzone: {
		title: "DZone",
		locale: "en-US",
		redirect_url: "http://www.dzone.com/links/add.html?url=" + postUrl + "&title=" + postTitle,
	  },
	  Folkd: {
		title: "Folkd",
		locale: "en-US",
		redirect_url: "http://www.folkd.com/page/social-bookmarking.html?addurl=" + postUrl,
	  },
	  Hatena: {
		title: "Hatena",
		locale: "en-US",
		redirect_url: "http://b.hatena.ne.jp/bookmarklet?url=" + postUrl + "&btitle=" + postTitle,
	  },
	  Jamespot: {
		title: "Jamespot",
		locale: "en-US",
		redirect_url: "//my.jamespot.com/",
	  },
	  Kakao: {
		title: "Kakao",
		locale: "en-US",
		redirect_url: "https://story.kakao.com/share?url=" + postUrl,
	  },
	  Kindle_It: {
		title: "Kindle_It",
		locale: "en-US",
		redirect_url: "//fivefilters.org/kindle-it/send.php?url=" + postUrl,
	  },
	  Known: {
		title: "Known",
		locale: "en-US",
		redirect_url: "https://withknown.com/share/?url=" + postUrl + "&title=" + postTitle,
	  },
	  Line: {
		title: "Line",
		locale: "en-US",
		redirect_url: "line://msg/text/" + postTitle + "! " + postUrl,
	  },
	  LiveJournal: {
		title: "LiveJournal",
		locale: "en-US",
		redirect_url: "http://www.livejournal.com/update.bml?subject=" + postTitle + "&event=" + postUrl,
	  },
	  Mail_Ru: {
		title: "Mail.Ru",
		locale: "en-US",
		redirect_url: "http://connect.mail.ru/share?share_url=" + postUrl,
	  },
	  Mendeley: {
		title: "Mendeley",
		locale: "en-US",
		redirect_url: "https://www.mendeley.com/sign-in/",
	  },
	  Meneame: {
		title: "Meneame",
		locale: "en-US",
		redirect_url: "https://www.meneame.net/submit.php?url=" + postUrl,
	  },
	  Mixi: {
		title: "Mixi",
		locale: "en-US",
		redirect_url: "https://mixi.jp/share.pl?mode=login&u=" + postUrl,
	  },
	  MySpace: {
		title: "Mixi",
		locale: "en-US",
		redirect_url: "https://myspace.com/",
	  },
	  Netlog: {
		title: "Netlog",
		locale: "en-US",
		redirect_url: "http://www.netlog.com/go/manage/links/view=save&origin=external&url=" + postUrl + "&title=" + postTitle + "&description=",
	  },
	  Netvouz: {
		title: "Netvouz",
		locale: "en-US",
		redirect_url: "http://www.netvouz.com/action/submitBookmark?url=" + postUrl + "&title=" + postTitle + "&popup=no&description=",
	  },
	  NewsVine: {
		title: "NewsVine",
		locale: "en-US",
		redirect_url: "http://www.newsvine.com/_tools/seed?popoff=0&u=" + postUrl + "&h=" + postTitle,
	  },
	  NUjij: {
		title: "NUjij",
		locale: "en-US",
		redirect_url: "http://www.nujij.nl/nieuw-bericht.2051051.lynkx?title=" + postTitle + "&url=" + postUrl + "&bericht=&topic=",
	  },
	  Odnoklassniki: {
		title: "Odnoklassniki",
		locale: "en-US",
		redirect_url: "https://connect.ok.ru/dk?cmd=WidgetSharePreview&st.cmd=WidgetSharePreview&st.shareUrl=" + postUrl + "&st.client_id=-1",
	  },
	  Oknotizie: {
		title: "Oknotizie",
		locale: "en-US",
		redirect_url: "//oknotizie.virgilio.it/post?url=" + postUrl + "&title=" + postTitle,
	  },
	  Outlook_com: {
		title: "Outlook.com",
		locale: "en-US",
		redirect_url: "https://mail.live.com/default.aspx?rru=compose?subject=" + postTitle + "&body=" + postUrl + "&lc=1033&id=64855&mkt=en-us&cbcxt=mai",
	  },
	  Protopage_Bookmarks: {
		title: "Protopage_Bookmarks",
		locale: "en-US",
		redirect_url: "http://www.protopage.com/add-button-site?url=" + postUrl + "&label=&type=page",
	  },
	  Pusha: {
		title: "Pusha",
		locale: "en-US",
		redirect_url: "//www.pusha.se/posta?url=" + postUrl,
	  },
	  Qzone: {
		title: "Qzone",
		locale: "en-US",
		redirect_url: "http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=" + postUrl,
	  },
	  Rediff_MyPage: {
		title: "Rediff MyPage",
		locale: "en-US",
		redirect_url: "//share.rediff.com/bookmark/addbookmark?bookmarkurl=" + postUrl + "&title=" + postTitle,
	  },
	  Renren: {
		title: "Renren",
		locale: "en-US",
		redirect_url: "//www.connect.renren.com/share/sharer?url=" + postUrl + "&title=" + postTitle,
	  },
	  Segnalo: {
		title: "Segnalo",
		locale: "en-US",
		redirect_url: "http://segnalo.virgilio.it/post.html.php?url=" + postUrl + "&title=" + postTitle,
	  },
	  Sina_Weibo: {
		title: "Sina Weibo",
		locale: "en-US",
		redirect_url: "//service.weibo.com/share/share.php?url=" + postUrl + "&title=" + postTitle,
	  },
	  SiteJot: {
		title: "SiteJot",
		locale: "en-US",
		redirect_url: "http://www.sitejot.com/loginform.php?iSiteAdd=&iSiteDes=",
	  },
	  Slashdot: {
		title: "Slashdot",
		locale: "en-US",
		redirect_url: "//slashdot.org/submission?url=" + postUrl,
	  },
	  Svejo: {
		title: "Svejo",
		locale: "en-US",
		redirect_url: "https://svejo.net/story/submit_by_url?url=" + postUrl + "&title=" + postTitle + "&summary=",
	  },
	  Symbaloo_Feeds: {
		title: "Symbaloo_Feeds",
		locale: "en-US",
		redirect_url: "//www.symbaloo.com/",
	  },
	  Tuenti: {
		title: "Tuenti",
		locale: "en-US",
		redirect_url: "https://www.tuenti.com/share?p=b5dd6602&url=" + postUrl,
	  },
	  Twiddla: {
		title: "Twiddla",
		locale: "en-US",
		redirect_url: "//www.twiddla.com/New.aspx?url=" + postUrl + "&title=" + postTitle,
	  },
	  Webnews: {
		title: "Webnews",
		locale: "en-US",
		redirect_url: "//www.webnews.de/login",
	  },
	  Wykop: {
		title: "Wykop",
		locale: "en-US",
		redirect_url: "//www.wykop.pl/dodaj?url=" + postUrl + "&title=" + postTitle,
	  },
	  Yoolink: {
		title: "Yoolink",
		locale: "en-US",
		redirect_url: "//yoolink.to/addorshare?url_value=" + postUrl + "&title=" + postTitle,
	  },
	  YouMob: {
		title: "YouMob",
		locale: "en-US",
		redirect_url: "//youmob.com/startmob.aspx?cookietest=true&mob=" + postUrl,
	  }
	}
	var theChampMoreSharingServicesHtml = '<button id="the_champ_sharing_popup_close" class="close-button separated"><img src="'+ theChampCloseIconPath +'" /></button><div id="the_champ_sharing_more_content"><div class="filter"><input type="text" onkeyup="theChampFilterSharing(this.value.trim())" placeholder="Search" class="search"></div><div class="all-services"><ul class="mini">';
	for(var i in theChampMoreSharingServices){
		var tempTitle = theChampCapitaliseFirstLetter(theChampMoreSharingServices[i].title.replace(/[_. ]/g, ""));
		theChampMoreSharingServicesHtml += '<li><a rel="nofollow" title="'+ theChampMoreSharingServices[i].title +'" alt="'+ theChampMoreSharingServices[i].title +'" ';
		if(theChampMoreSharingServices[i].bookmarklet_url){
			theChampMoreSharingServicesHtml += 'href="' + theChampMoreSharingServices[i].bookmarklet_url + '" ';
		}else{
			theChampMoreSharingServicesHtml += 'onclick="theChampPopup(\'' + theChampMoreSharingServices[i].redirect_url + '\')" href="javascript:void(0)" ';
		}
		theChampMoreSharingServicesHtml += '"><i style="width:22px;height:22px" title="'+ theChampMoreSharingServices[i].title +'" class="theChampSharing theChamp' + tempTitle + 'Background"><ss style="display:block;width:100%;height:100%;" class="theChampSharingSvg theChamp' + tempTitle + 'Svg"></ss></i>' + theChampMoreSharingServices[i].title + '</a></li>';
	}
	theChampMoreSharingServicesHtml += concate;
	
	var mainDiv = document.createElement('div');
	mainDiv.innerHTML = theChampMoreSharingServicesHtml;
	mainDiv.setAttribute('id', 'the_champ_sharing_more_providers');
	var bgDiv = document.createElement('div');
	bgDiv.setAttribute('id', 'the_champ_popup_bg');
	jQuery('body').append(mainDiv).append(bgDiv);
	document.getElementById('the_champ_sharing_popup_close').onclick = function(){
		mainDiv.parentNode.removeChild(mainDiv);
		bgDiv.parentNode.removeChild(bgDiv);
	}
}
if(typeof theChampHorizontalSharingCountEnable == 'undefined'){
	var theChampHorizontalSharingCountEnable = 0;
}
if(typeof theChampVerticalSharingCountEnable == 'undefined'){
	var theChampVerticalSharingCountEnable = 0;
}
if( theChampHorizontalSharingCountEnable || theChampVerticalSharingCountEnable ){
	// get sharing counts on window load
	theChampLoadEvent(
		function(){
			// sharing counts
			theChampCallAjax(function(){
				theChampGetSharingCounts();
			});
		}
	);
}
	
/**
 * Search sharing services
 */
function theChampFilterSharing(val) {
	jQuery('ul.mini li a').each(function(){
		if (jQuery(this).text().toLowerCase().indexOf(val.toLowerCase()) != -1) {
			jQuery(this).parent().css('display', 'block');
		} else {
			jQuery(this).parent().css('display', 'none');
		}
	});
};

/**
 * Get sharing counts
 */
function theChampGetSharingCounts(){
	var targetUrls = [];
	jQuery('.the_champ_sharing_container').each(function(){
		if(typeof jQuery(this).attr('super-socializer-no-counts') == 'undefined'){
			var currentTargetUrl = jQuery(this).attr('super-socializer-data-href');
			if(currentTargetUrl != null && jQuery.inArray(currentTargetUrl, heateorSsUrlCountFetched) == -1){
				targetUrls.push(currentTargetUrl);
				heateorSsUrlCountFetched.push(currentTargetUrl);
			}
		}
	});
	if(targetUrls.length == 0){
		return;
	}
	jQuery.ajax({
		type: 'GET',
		dataType: 'json',
		url: theChampSharingAjaxUrl,
		data: {
			action: 'the_champ_sharing_count',
			urls: targetUrls,
		},
		success: function(data, textStatus, XMLHttpRequest){
			if(data.status == 1){
				for(var i in data.message){
					var sharingContainers = jQuery("div[super-socializer-data-href='"+i+"']");

					jQuery(sharingContainers).each(function(){
						var totalCount = 0;
						for(var j in data.message[i]){
							if(j == 'google_plus'){
								var sharingCount = parseInt(data.message[i][j]) || 0;
							}else if(j == 'vkontakte'){
								var sharingCount = parseInt(data.message[i][j].replace('VK.Share.count(0, ', '').replace(');', ''));
							}else{
								var sharingCount = data.message[i][j];
							}

							var targetElement = jQuery(this).find('.the_champ_'+j+'_count');
							
							if(jQuery(targetElement).attr('ss_st_count')){
								sharingCount = parseInt(sharingCount) + parseInt(jQuery(targetElement).attr('ss_st_count'));
							}
							totalCount += parseInt(sharingCount);
							if(sharingCount < 1){ continue; }
							jQuery(targetElement).html(theChampCalculateCountWidth(sharingCount)).css({'visibility': 'visible', 'display': 'block'});
							
							if ( ( typeof theChampReduceHorizontalSvgWidth != 'undefined' && jQuery(this).hasClass('the_champ_horizontal_sharing') ) || ( typeof theChampReduceVerticalSvgWidth != 'undefined' && jQuery(this).hasClass('the_champ_vertical_sharing') ) ) {
								jQuery(targetElement).parents('li').find('.theChampSharingSvg').css('float', 'left');
							}
							if ( ( typeof theChampReduceHorizontalSvgHeight != 'undefined' && jQuery(this).hasClass('the_champ_horizontal_sharing') ) || ( typeof theChampReduceVerticalSvgHeight != 'undefined' && jQuery(this).hasClass('the_champ_vertical_sharing') ) ) {
								jQuery(targetElement).parents('li').find('.theChampSharingSvg').css('marginTop', '0');
							}
						}
						var totalCountContainer = jQuery(this).find('.theChampTCBackground');
						jQuery(totalCountContainer).each(function(){
							var containerHeight = jQuery(this).css('height');
							jQuery(this).html('<div class="theChampTotalShareCount" style="font-size: '+ (parseInt(containerHeight) * 62/100) +'px">' + theChampCalculateCountWidth(totalCount) + '</div><div class="theChampTotalShareText" style="font-size: '+ (parseInt(containerHeight) * 38/100) +'px">' + (totalCount < 2 ? heateorSsShareText : heateorSsSharesText) + '</div>').css('visibility', 'visible');
						});
					});
				}
			}
		}
	});
}

function theChampCalculateCountWidth(sharingCount){
	if(sharingCount > 999 && sharingCount < 10000){
		sharingCount = Math.round(sharingCount/1000) + 'K';
	}else if(sharingCount > 9999 && sharingCount < 100000){
		sharingCount = Math.round(sharingCount/1000) + 'K';
	}else if(sharingCount > 99999 && sharingCount < 1000000){
		sharingCount = Math.round(sharingCount/1000) + 'K';
	}else if(sharingCount > 999999){
		sharingCount = Math.round(sharingCount/1000000) + 'M';
	}
	return sharingCount;
}

function theChampCapitaliseFirstLetter(e) {
    return e.charAt(0).toUpperCase() + e.slice(1)
}

jQuery(function(){
	var classes = ['the_champ_vertical_sharing', 'the_champ_vertical_counter'];
	for(var i = 0; i < classes.length; i++){
		if(jQuery('.' + classes[i]).length){
			jQuery('.' + classes[i]).each(function(){
				var verticalSharingHtml = jQuery(this).html();
				if(jQuery(this).attr('style').indexOf('right') >= 0){
					var removeClass = 'theChampPushIn', margin = 'Right', alignment = 'right', addClass = 'theChampPullOut';
				}else{
					var removeClass = 'theChampPullOut', margin = 'Left', alignment = 'left', addClass = 'theChampPushIn';
				}
				jQuery(this).html(verticalSharingHtml + '<div title="Hide" style="float:' + alignment + '" onclick="theChampHideSharing(this, \''+ removeClass +'\', \''+ addClass +'\',\'' + margin +'\', \'' + alignment + '\')" class="theChampSharingArrow ' + removeClass + '"></div>');
			});
		}
	}
});

function theChampHideSharing(elem, removeClass, addClass, margin, alignment){
	var animation = {}, counter = jQuery(elem).parent().hasClass('the_champ_vertical_counter'), offset = parseInt(jQuery(elem).parent().css('width')) + 10 - (counter ? 16 : 0);
	var ssOffset = jQuery(elem).parent().attr('ss-offset');
	if(ssOffset){
		var savedOffset = parseInt(ssOffset);
	}else{
		var savedOffset = (counter ? theChampCounterOffset : theChampSharingOffset);
	}
	if(jQuery(elem).attr('title') == 'Hide'){
		animation[alignment] = "-=" + (offset + savedOffset);
		jQuery(elem).parent().animate(animation, 400, function(){
			jQuery(elem).removeClass(removeClass).addClass(addClass).attr('title', 'Share');
			if(counter){
				var cssFloat = alignment == 'left' ? 'right' : 'left';
				jQuery(elem).css('float', cssFloat);
			}else{
				jQuery(elem).css('margin' + margin, offset + 'px')
			}
		});
	}else{
		animation[alignment] = "+=" + (offset + savedOffset); 
		jQuery(elem).parent().animate(animation, 400, function(){
			jQuery(elem).removeClass(addClass).addClass(removeClass).attr('title', 'Hide');
			if(counter){
				jQuery(elem).css('float', alignment);
			}else{
				jQuery(elem).css('margin' + margin, '0px');
			}
		});
	}
}