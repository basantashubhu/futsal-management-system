function itemsSummary(container, name){

    let categories = container.find(name).toArray();
    let summary = categories.reduce((acc, iterator) => {
        let selectedOption = $(iterator).find('option:selected');
        if(selectedOption.length > 0){			

            let parentRow = $(iterator).closest('tr')
            let category = selectedOption.text();
            let item = $(iterator).attr('data-stipend-category')
            let amount = parentRow.find('.appendAmount').val();
            let desiredObject = {
                category,
                item,
                amount,
                count : 1
            }

            let push = true;

            acc.forEach(t =>{
                if(t.category === desiredObject.category && t.item === desiredObject.item && desiredObject.amount === t.amount){
                    t.count += 1;
                    push = false;
                }
            })	

            if(acc.length < 1 || push){
                acc = [...acc, desiredObject];
            }

            return acc;		

        }else{
            return acc;
        }

    }, []);

    summary.sort(function(a,b){
        return b.item.charCodeAt(0) - a.item.charCodeAt(0);
    })

    let mapSummary = (summaryContainer) => {
        let summaryHTML = '<table class="table items-map-table borderless">';

        if(summary.length < 1){
            summaryContainer.html('')
            return;
        }	

        $(summary).each((index, summaryDetail) => {
            summaryHTML += `
                <tr class="f-w-400 fs">
                    <td>
                        ${summaryDetail.item}&nbsp;-&nbsp;${summaryDetail.category}
                    </td>
                    <td>Count ${summaryDetail.count}</td>
                    <td>@&nbsp; $${summaryDetail.amount}</td>
                </tr>	
            `.trim();

        });
        summaryHTML += "</table>";
        summaryContainer.html(summaryHTML);
    }

    return {
        summary,
        mapSummary
    };

}	

function itemMap({table, holder, name} = {
    table : $('.vol-site-tab-content .tab-pane.active'),
    holder : $('.totalSummary'),
    name : '[name ^= "item[value]"]'
}){
    var sum = itemsSummary(table, name)
    sum.mapSummary(holder);
}