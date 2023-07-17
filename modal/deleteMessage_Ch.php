<!-- 以下刪除提示 -->
<div class="modal fade" id="exampleModal<?= $row["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">確認刪除</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              確定刪除該張優惠券嗎?
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">否</button>
                              <a href="doDelete_Ch.php?id=<?= $row["id"] ?>" type="button" class="btn btn-primary">是</a>
                          </div>
                      </div>
                  </div>
              </div>
<!-- 以上刪除提示 -->