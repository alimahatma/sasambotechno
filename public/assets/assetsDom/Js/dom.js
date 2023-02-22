// const ADD_PRODUCT_TO_CART_SHOPPING = "AddProductToCartShopping"
// const BUY_NOW_PRODUCT = "buyNowProduct"
// const PPRODUK_CUSTOM_ID = "GetValueProcusId"
// const MEMBER_ID = "getUserId"
// function AddprodukToCart() {
//     const AddProductToCartShopping = document.getElementById(ADD_PRODUCT_TO_CART_SHOPPING)
//     const buyNowProduct = document.getElementById(BUY_NOW_PRODUCT)
//     const getNamaProduk = document.getElementById('GetNamaProduk').value
//     const getHargaSatuan = document.getElementById('GetHargaSatuan').value
//     const getValueProcusId = document.getElementById('GetValueProcusId').value
//     const getJumlahOrder = document.getElementById('jml').value
//     const getValueColor = document.getElementById('GetValueColor').value
//     const getValueSize = document.getElementById('GetValueSize').value
//     const getTotal = document.getElementById('total').value
//     const ProdukCustom = makeProdukCustom(getNamaProduk, getHargaSatuan, getValueProcusId, getJumlahOrder, getValueColor, getValueSize, getTotal)
//     const ProdukCustomObject = composeProdukCustomObject(getNamaProduk, getHargaSatuan, getValueProcusId, getJumlahOrder, getValueColor, getValueSize, getTotal)
//     ProdukCustom[PRODUK_CUSTOM_ID] = ProdukCustomObject.id
//     ProdukCustoms.push(ProdukCustomObject)
//     if (PRODUK_CUSTOM_ID == true) {

//     }
// }

$(document).ready(function () {
    ShowCartData()
})
function AddToCart() {
    const getValueProcusId = document.getElementById('GetValueProcusId').value
    const getNamaProduk = document.getElementById('GetNamaProduk').value
    const getHargaSatuan = document.getElementById('GetHargaSatuan').value
    const getJumlahOrder = document.getElementById('jml').value
    const getValueColor = document.getElementById('GetValueColor').value
    const getValueSize = document.getElementById('GetValueSize').value
    const getTotal = document.getElementById('total').value

    let CartItem = {
        ProdukCustomId: getValueProcusId,
        ProductName: getNamaProduk,
        HargaSatuan: getHargaSatuan,
        JumlahOrder: getJumlahOrder,
        Warnaproduk: getValueColor,
        SizeProduk: getValueSize,
        TotalHarga: getTotal,
    }
    CartItemJson = JSON.stringify(CartItem)
    let CartArray = new Array();

    // cek apakah shoping cart tidak sama dengan kosong
    if (sessionStorage.getItem('shopping-cart')) {
        CartArray = JSON.parse(sessionStorage.getItem('shopping-cart'))
    }
    CartArray.push(CartItemJson);

    let cartJson = JSON.stringify(CartArray)
    sessionStorage.setItem('shopping-cart', cartJson)
    ShowCartData()
}
function emptyCart() {
    if (sessionStorage.getItem('shopping-cart')) {
        sessionStorage.removeItem('shopping-cart')
        ShowCartData()
    }
}

function removeCartItem(index) {
    if (sessionStorage.getItem('shopping-cart')) {
        let shoppingCart = JSON.parse(sessionStorage.getItem('shopping-cart'))
        sessionStorage.removeItem(shoppingCart[index])
        ShowCartData();
    }
}
function ShowCartData() {
    let cartRowData = ""
    let itemCount = 0
    let hargaTotal = 0

    let hargaSatuan = 0
    let jumlahOrder = 0
    let SubtotalProduk = 0
    if (sessionStorage.getItem('shopping-cart')) {
        let shoppingCart = JSON.parse(sessionStorage.getItem('shopping-cart'))
        itemCount = shoppingCart.length

        shoppingCart.forEach(function (item) {
            let cartItem = JSON.parse(item)
            produk_custom_id = parseInt(cartItem.ProdukCustomId)
            nama_produk = parseInt(cartItem.ProductName)
            harga_satuan = parseInt(cartItem.HargaSatuan)
            jumlah_order = parseInt(cartItem.JumlahOrder)
            warna_produk = parseInt(cartItem.Warnaproduk)
            size_produk = parseInt(cartItem.SizeProduk)
            total_harga = parseInt(cartItem.TotalHarga)
        })
    }
}