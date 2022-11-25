const submitRoute   = document.querySelector("meta[name='search-route']").getAttribute("content");
const CSRFToken     = document.querySelector("meta[name='csrf-token']").getAttribute("content");
window.onload = function()
{
    let searchButton        = document.querySelector("#load-more-button");
    let filterForm          = document.querySelector("#filter-form");
    let searchInput         = document.querySelector("#search-input");
    let productsContainer   = document.querySelector("#products");
    let resultsCounter      = document.querySelector("#result-counter");
    let loadMoreButton      = document.querySelector("#load-more-button");
    let currentItemsCount   = 0;
    let s;

    // render products to the view
    let renderData = function(products, count, isMore)
    {

        // no more data
        if(count == currentItemsCount)
            alert("No more data to show");

        // increase viewed products counter
        currentItemsCount += products.length;

        if(count > 0) {
            resultsCounter.innerHTML = count + " " + resultsCounter.dataset.foundText;
        } else {
            resultsCounter.innerHTML = resultsCounter.dataset.emptyText;
        }
        
        if(!isMore)
            productsContainer.innerHTML = "";
        
        for(product of products)
        {
            let div = document.createElement("div");
            div.setAttribute("class", "col-6 mb-4");
            div.innerHTML = "<div class='product'>" + product.product + "</div>";
            productsContainer.appendChild(div);
        }
    }

    let sendRequest = function(isMore = 0)
    {
        if(!isMore) currentItemsCount = 0;

        clearTimeout(s);
        let data = new FormData(filterForm);
        let xhr = new XMLHttpRequest();
        xhr.onload = function()
        {
            let parsed = JSON.parse(this.response);
            if(parsed.state == "success") {
                renderData(parsed.data, parsed.count, isMore);
            } else {
                alert("Error");
            }
        }
        data.append("_token", CSRFToken);
        data.append("start", currentItemsCount);

        xhr.open("POST", submitRoute, true);
        xhr.send(data);
    }

    // for any change in the form (search or checkboxes)
    filterForm.onchange = function()
    {
        sendRequest();
    }
    
    // if the user stopped typing show the results
    searchInput.oninput = function()
    {
        clearTimeout(s);
        s = setTimeout(sendRequest, 1000);
    }

    // Load more
    loadMoreButton.onclick = function()
    {
        sendRequest(true);
    }

    // initial view
    sendRequest();
}