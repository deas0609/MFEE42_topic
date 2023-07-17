<!--搜尋sidebar  -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">搜尋條件</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="dosearch_Ch.php">
            <div class="my-3">
                <label for="">名稱搜尋</label>
                <input type="text" class="form-control" name="searchName" placeholder="搜尋優惠券名稱">
            </div>
            <div class="my-3">
                <label for="">折扣價格搜尋</label>
                <div class="d-flex align-items-center">
                    <input type="text" class="form-control px-2" name="discountmin" placeholder="最小折扣">
                    <div> ~ </div>
                    <input type="text" class="form-control px-2" name="discountMax" placeholder="最大折扣">
                </div>
            </div>
            <div class="my-3">
                <label for="">有效日期搜尋</label>
                <div class="d-flex align-items-center">
                    <input type="date" class="form-control px-2" name="datemin" placeholder="最小日期">
                    <div> ~ </div>
                    <input type="date" class="form-control px-2" name="dateMax" placeholder="最大日期">
                </div>
            </div>
            <label for="">折扣分類</label>
            <div class="d-flex justify-content-start mb-4">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="countType" id="inlineRadio1" value="1">
                    <label class="form-check-label" for="inlineRadio1">固定折扣</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="countType" id="inlineRadio2" value="2">
                    <label class="form-check-label" for="inlineRadio2">百分比折扣</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input active" type="radio" name="countType" id="inlineRadio2" value="0">
                    <label class="form-check-label " for="inlineRadio2">不區分</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">搜尋</button>
        </form>
    </div>
</div>
<!--搜尋sidebar  -->