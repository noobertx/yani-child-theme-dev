(function($){
Custom_Search = ()=>{
  // 1. describe and create/initiate our object
  
   


  // 2. events
  events=()=> {
    this.openButton.on("click", this.openOverlay.bind(this));
    this.closeButton.on("click", this.closeOverlay.bind(this));
    $(document).on("keydown", this.keyPressDispatcher.bind(this));
    this.searchField.on("keyup", this.typingLogic.bind(this));
  }
  

  // 3. methods (function, action...)
  typingLogic=()=> {
      // console.log("Typing logic");
    if (this.searchField.val() != this.previousValue) {
      clearTimeout(this.typingTimer);

      if (this.searchField.val()) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.html('<div class="spinner-loader"></div>');
          this.isSpinnerVisible = true;
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 750);
      } else {
        this.resultsDiv.html('');
        this.isSpinnerVisible = false;
      }

    }

    this.previousValue = this.searchField.val();
  }


  renderResults = (collection,title)=>{
    var str = "";
    if(collection.length){
      str += '<h2 class="search-overlay__section-title">'+title+'</h2>';
      str += '<ul class="result-posts-list">';
      str += collection.map(item => `
                <li class="">
                  <a class="professor-card" href="${item.permalink}">
                    <img src="${item.image}">
                    <span class="professor-card__name">${item.title}</span>
                  </a>
                </li>
              `).join('')
      str += '</ul>';
    }
    return str;
  }


  getResults=()=> {
      var context = this;
    $.getJSON(searchData.root_url+'/wp-json/search/v1/item?term= '+this.searchField.val(),function (results){
        context.resultsDiv.html(
          `<div class='row'>
            <div class='col-md-6 col-12'>
            ${renderResults(results.posts,"Posts")}
            </div>
            <div class='col-md-6 col-12'>
            ${renderResults(results.products,"Products")}
            </div>
          </div>`
        );
      context.isSpinnerVisible = false;
    },this);

  }

  keyPressDispatcher=(e)=> {
    if (e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus')) {
      this.openOverlay();
    }

    if (e.keyCode == 27 && this.isOverlayOpen) {
      this.closeOverlay();
    }

  }

  openOverlay=()=> {
    this.searchOverlay.addClass("search-overlay--active");
    $("body").addClass("body-no-scroll");
    this.searchField.val('');
    setTimeout(() => this.searchField.focus(), 301);
    this.isOverlayOpen = true;
    return false;
  }

  closeOverlay=()=> {
    this.searchOverlay.removeClass("search-overlay--active");
    $("body").removeClass("body-no-scroll");
    this.isOverlayOpen = false;
  }

  const addSearchHTML=()=> {
    $("body").append(`
      <div class="search-overlay">
        <div class="search-overlay__top">
          <div class="container">
            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
            <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
            <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
          </div>
        </div>
        
        <div class="container">
          <div id="search-overlay__results"></div>
        </div>

      </div>
    `);
  }

   addSearchHTML();
    this.resultsDiv = $("#search-overlay__results");
    this.openButton = $(".js-search-trigger");
    this.closeButton = $(".search-overlay__close");
    this.searchOverlay = $(".search-overlay");
    this.searchField = $("#search-term");
    this.events();
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.previousValue;
    this.typingTimer;

}

Custom_Search();
})(jQuery)
