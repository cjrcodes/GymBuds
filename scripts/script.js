window.onresize = window.onload = function () {
    const mainWrapper = document.getElementById('main-wrapper');
    const mainWrapperHeight = mainWrapper.offsetHeight;
    var isFooterHidden = false;
    const footer = document.querySelector('footer');

    const vw = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
    const vh = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);


    //this.console.log(footer.offsetHeight);
    //this.console.log(mainWrapperHeight);
    if (mainWrapperHeight > vh - 50) {
        //console.log("This works");
        footer.style.display = "none";
        isFooterHidden = true;
    } else {
        footer.style.display = "block";
        isFooterHidden = false;
    }

    if (!isFooterHidden) {
        footer.style.height = vh - 30;
    }
};