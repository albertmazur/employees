import './bootstrap'

const checkboxes = document.querySelectorAll('input[name="employee_ids[]"]')
let selectedItems = JSON.parse(localStorage.getItem('selected')) || []
const exportErrorMessage = document.getElementById("export-error-message")
const spanCounter = document.getElementById("count-export")
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
    exportErrorMessage.textContent = ''
    if (Array.isArray(selectedItems) && selectedItems.length>0) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

        fetch('/download', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            json: JSON.stringify({ employee_ids: selectedItems }),
        })
        .then(response => {
            console.log(response)
            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`)
            return response.blob()
        })
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = "aa.json";
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
        })
        .catch(error => {
            console.error(error)
            exportErrorMessage.textContent = "Błąd podczas pobierania pliku"
        })
    }
    else {
        exportErrorMessage.textContent = "Lista ID nie jest dostępna lub jest pusta."
    }
})

document.getElementById("resetExport").addEventListener("click", ()=>{
    localStorage.removeItem('selected')

    checkboxes.forEach(checkbox => {
        if(checkbox.checked) checkbox.checked = false
    })

    spanCounter.textContent = '0'
})