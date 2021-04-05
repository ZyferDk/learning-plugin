// ajidk
window.addEventListener('load', () => {
    let tabs = document.querySelectorAll('ul.nav-tabs >li');

    tabs.forEach((tab) => {
        tab.addEventListener('click', switchTab);
    })

    function switchTab(e) {
        e.preventDefault();
        
        document.querySelector("ul.nav-tabs li.active").classList.remove("active");
        document.querySelector(".tab-pane.active").classList.remove("active");

        let clickedTab = e.currentTarget;
        let anchor = e.target;
        let activePaneID = anchor.getAttribute('href');

        console.log(activePaneID);

        clickedTab.classList.add('active')
        document.querySelector(activePaneID).classList.add('active')
    }
})