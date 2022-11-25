const submitRoute   = document.querySelector("meta[name='search-route']").getAttribute("content");
const CSRFToken     = document.querySelector("meta[name='csrf-token']").getAttribute("content");
window.onload = function()
{
    let searchButton        = document.querySelector("#load-more-button");
    let filterForm          = document.querySelector("#filter-form");
    let searchInput         = document.querySelector("#search-input");
    let productsContainer   = document.querySelector("#products");
    let resultsCounter      = document.querySelector("#result-counter");
    let s;

    // render products to the view
    let renderData = function(products, count)
    {
        if(count > 0) {
            resultsCounter.innerHTML = count + " " + resultsCounter.dataset.foundText;
        } else {
            resultsCounter.innerHTML = resultsCounter.dataset.emptyText;
        }
        productsContainer.innerHTML = "";
        for(product of products)
        {
            let div = document.createElement("div");
            div.setAttribute("class", "col-6 mb-4");
            div.innerHTML = "<div class='product'>" + product.product + "</div>";
            productsContainer.appendChild(div);
        }
    }

    // if the user stopped typing show the results
    let sendRequest = function()
    {
        clearTimeout(s);
        let data = new FormData(filterForm);
        let xhr = new XMLHttpRequest();
        xhr.onload = function()
        {
            let parsed = JSON.parse(this.response);
            if(parsed.state == "success") {
                renderData(parsed.data, parsed.count);
            } else {
                alert("Error");
            }
        }
        data.append("_token", CSRFToken);

        xhr.open("POST", submitRoute, true);
        xhr.send(data);
    }

    // for any change in the form (search or checkboxes)
    filterForm.onchange = sendRequest;
    
    searchInput.oninput = function()
    {
        clearTimeout(s);
        s = setTimeout(sendRequest, 1000);
    }
}