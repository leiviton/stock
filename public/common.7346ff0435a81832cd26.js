(window.webpackJsonp=window.webpackJsonp||[]).push([[0],{"Uo/Y":function(e,t,r){"use strict";r.d(t,"a",function(){return a});var o=r("t/Na"),s=r("AytR"),i=r("4GxJ"),a=(r("EThc"),function(){function e(e,t,r,o,s,i){this.http=e,this.router=t,this.toast=r,this.loading=o,this.modalService=s,this.jwtHelper=i,this.token=null,this.closeResult="",this.setAccessToken()}return e.prototype.request=function(){return this.http},e.prototype.setAccessToken=function(){this.token=localStorage.getItem("token"),this.header=new o.g({Authorization:"Bearer "+this.token,Accept:"application/json"})},e.prototype.builder=function(e){return this.url=s.a.server_url+"/api/v1/"+e,this},e.prototype.list=function(e){void 0===e&&(e={});var t=this.url;if(void 0!==e.filters){t+="?";var r=[];e.filters.forEach(function(e,o){var s=Object.keys(e)[0],i=e[s];r.push({field:i}),t=t+"where["+s+"]="+i+"&"});var o=this.http.get(t,{headers:this.header});return this.toPromise(o)}return o=this.http.get(t,{headers:this.header}),this.toPromise(o)},e.prototype.search=function(e){var t=this.http.get(this.url+"?value="+e,{headers:this.header});return this.toPromise(t)},e.prototype.view=function(e,t,r){void 0===r&&(r="");var o=this.http.get(this.url+t+"/"+e+r,{headers:this.header});return this.toPromise(o)},e.prototype.update=function(e,t){var r=this.http.put(this.url+"/"+e,t,{headers:this.header});return this.toPromise(r)},e.prototype.insert=function(e){var t=this.http.post(this.url,e,{headers:this.header});return this.toPromise(t)},e.prototype.delete=function(e){var t=this.http.delete(this.url+"/"+e,{headers:this.header});return this.toPromise(t)},e.prototype.open=function(e,t){var r=this;this.modalReference=this.modalService.open(e,t),this.modalReference.result.then(function(e){r.closeResult="Closed with: "+e},function(e){r.closeResult="Dismissed "+r.getDismissReason(e)})},e.prototype.getDismissReason=function(e){return e===i.a.ESC?"by pressing ESC":e===i.a.BACKDROP_CLICK?"by clicking on a backdrop":"with: "+e},e.prototype.toPromise=function(e){var t=this;return this.loading.show(),e.toPromise().then(function(e){return t.loading.hide(),e||{}}).catch(function(e){t.loading.hide();var r="Algo deu errado, informe o erro "+e.status+" ao administrador";switch(e.status){case 401:r="Voc\xea n\xe3o tem permiss\xe3o para acessar, informe um usuario e senha validos",localStorage.clear(),null!=t.modalReference&&t.modalReference.close(),t.toast.error(r,"Erro"),t.router.navigate(["/login"]);break;case 403:r=e.error.error_description,null!=t.modalReference&&t.modalReference.close(),t.toast.error(r,"Erro");break;case 500:t.toast.error(r,"Erro"),t.router.navigate(["/pages/error"]);break;case 422:t.bodyRequest=JSON.parse(e._body),t.toast.error(t.bodyRequest.message,t.bodyRequest.title);break;case 406:t.bodyRequest=e.error,t.toast.error(t.bodyRequest.message,t.bodyRequest.title)}})},e}())}}]);