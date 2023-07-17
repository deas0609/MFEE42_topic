   <!-- 更新訊息 -->
   <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">即時訊息</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    優惠券更新成功
                </div>
                <div class="modal-footer">
                    <a href="discountIndex_Ch.php" type="button" class="btn btn-secondary">返回列表</a>
                    <a href="editPage_Ch.php?id=<?= $row["id"] ?>" type="button" class="btn btn-primary">繼續更新</a>
                </div>
            </div>
        </div>
    </div>
    <!-- 更新訊息 -->