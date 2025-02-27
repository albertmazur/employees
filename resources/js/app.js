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
            body: JSON.stringify({ employee_ids: selectedItems })
        })
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`)
            return response.blob()
        })
        .then(blob => {
            const url = window.URL.createObjectURL(blob)
            const a = document.createElement('a')
            a.href = url
            a.download = "listEmployee.json"
            document.body.appendChild(a)
            a.click()
            document.body.removeChild(a)
            window.URL.revokeObjectURL(url)

            resetExportEmployeeId()
        })
        .catch(error => {
            exportErrorMessage.textContent = translations.download_error
        })
    }
    else {
        exportErrorMessage.textContent = translations.empty_list_error
    }
})

document.getElementById("resetExport").addEventListener("click", ()=>{
    resetExportEmployeeId()
})

function resetExportEmployeeId(){
    localStorage.removeItem('selected')
    selectedItems = []

    checkboxes.forEach(checkbox => {
        if(checkbox.checked) checkbox.checked = false
    })

    spanCounter.textContent = '0'
}