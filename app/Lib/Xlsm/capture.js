const fs = require('fs')
const args = process.argv
const XLSX = require('xlsx')

const workbook = XLSX.readFile(args[2], { bookVBA: true })
let worksheet = workbook.Sheets['Data Sheet']


let csv = XLSX.readFile(args[3], { raw: true }).Sheets.Sheet1

const csvData = Object.entries(csv).filter(function ([key]) {
    let number = Number(key.replace(/[^\d]/g, ''))
    return number > 3
}).map(([key, value]) => [key, value['v']]).reduce((acc, [key, value]) => {
    let number = Number(key.replace(/[^\d]/g, ''))
    if (number in acc) {
        acc[number].push([key, value])
    } else {
        acc[number] = [[key, value]]
    }
    return acc
}, {})

let data = Object.entries(csvData).map(([key, value]) => value)

const columns = Object.entries(csv).filter(function ([key]) {
    let number = Number(key.replace(/[^\d]/g, ''))
    return number === 2
}).map(([key]) => key.replace(/[\d]/g, ''))

const finalize = []
for (const properties of data) {
    const newProperteis = {}
    for (const col of columns) {
        newProperteis[col] = ''
        for (const [key, value] of properties) {
            if (key.replace(/[\d]/g, '') !== col) continue
            newProperteis[col] = value
        }
    }
    finalize.push(Object.entries(newProperteis).map(([key, value]) => value))
}
// return console.log(JSON.stringify(finalize));

XLSX.utils.sheet_add_aoa(worksheet, finalize, { origin: 'C4' })

XLSX.writeFile(workbook, args[4], { bookType: 'xlsm' })
