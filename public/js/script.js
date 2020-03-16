$(document).ready(function () {
  $('.btn-price').on('click',function (e) {

        e.preventDefault();
        let product = $(this).attr('data-product');
        let price = $(this).parent().find('input').val();

        axios.post('/product/'+product+'/price',{
           price: price
        }).then(function (res) {
            if(res.data.success){
                alert('Цена изменена!')
                return
            }

            alert(res.data.error)
        })
  })
})
