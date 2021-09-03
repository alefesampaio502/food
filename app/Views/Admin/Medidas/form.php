      <div class="form-row">
             <div class="form-group col-md-6">
               <label for="nome"> Nome: <span class="text-danger">*</span> </label>
               <input type="text" class="form-control" name="nome" id="nome" value="<?php echo old('name', esc($medida->nome));?>">
             </div>

             <div class="form-group col-md-6">
									<label for="ativo"> Ativo: <span class="text-danger">*</span> </label>
                  <select class="form-control form-control-ativo" name="ativo" required>
                     <?php if($medida->id): ?>
                       <option value="1"<?php echo ($medida->ativo ? 'selected' : ''); ?>>Sim</option>
                       <option value="0"<?php echo (!$medida->ativo ? 'selected' : ''); ?>>Não</option>
                     <?php else : ?>
                       <option value="1" class="text-success">Sim</option>
                       <option value="0" selected="">Não</option>
                     <?php endif ?>
                 </select>
             </div>
             <div class="form-group col-md-12">
               <label for="nome">Descrição: <span class="text-danger">*</span> </label>
               <textarea class="form-control text-black" name="descricao" rows="2" id="descricao"><?php echo old('descricao', esc($medida->descricao));?></textarea>
               </div>
           </div>
             <button type="submit" class="btn btn-primary mr-2 btn-sm"><i class=" mdi mdi-content-save btn-icon-prepend mr-1"></i>Salvar
             </button>
