import './bootstrap';

const checkboxes = document.querySelectorAll('input[name="employee_ids[]"]')
let selectedItems = JSON.parse(localStorage.getItem('selected')) || []
let spanCounter = document.getElementById("count-export")
spanCounter.textContent = selectedItems.length

checkboxes.forEach(checkbox =>{
    checkbox.checked = selectedItems.includes(checkbox.value)
    
    checkbox.addEventListener("change", (e) =>{
        if(e.target.checked) selectedItems.push(e.target.value)
        else selectedItems = selectedItems.filter(item => item !== e.target.value)
            
        spanCounter.textContent = selectedItems.length
        localStorage.setItem('selected', JSON.stringify(selectedItems))
    })
})

document.getElementById("downloadButton").addEventListener("click", ()=>{
    document.getElementById("checkboxForm").submit()

    if (idList && Array.isArray(idList)) {
        // Przykład wysyłania danych (np. AJAX, fetch, itp.)
        fetch('/your-endpoint', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ ids: idList }),
        })
        .then(response => response.json())
        .then(data => {
            console.log('Sukces:', data);
        })
        .catch(error => {
            console.error('Błąd:', error);
        });
    } else {
        console.error('Lista ID nie jest dostępna lub jest pusta.');
    }
})

document.getElementById("resetExport").addEventListener("click", ()=>{
    localStorage.removeItem('selected')

    checkboxes.forEach(checkbox => {
        if(checkbox.checked) checkbox.checked = false
    })

    spanCounter.textContent = '0'
})