      <div class="form-row">
        <?php if(!$bairro->id): ?>
          <div class="form-group col-md-3">
            <label for="cep"> Cep: <span class="text-danger">*</span></label>
            <input type="text" class=" cep form-control" name="cep"  value="<?php echo old('cep', esc($bairro->cep));?>">
            <div id="cep"></div>
          </div>
        <?php endif;?>
             <div class="form-group col-md-3">
               <label for="nome"> Nome: <span class="text-danger">*</span> </label>
               <input type="text" class="form-control" name="nome" id="nome" value="<?php echo old('name', esc($bairro->nome));?>" readonly="">
             </div>

             <div class="form-group col-md-3">
               <label for="Cidade"> Cidade: <span class="text-danger">*</span> </label>
               <input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo old('cidade', esc($bairro->cidade));?>" readonly="">
             </div>
               <?php if(!$bairro->id): ?>
             <div class="form-group col-md-3">
               <label for="Estado">Estado:</label>
               <input type="text" class="uf form-control" name="estado" id="estado" readonly="">
             </div>
           <?php endif;?>
             <div class="form-group col-md-3">
               <label for="valor_entrega">Valor de entrega: <span class="text-danger">*</span> </label>
               <input type="text" class="form-control money" name="valor_entrega" id="valor_entrega" value="<?php echo old('valor_entrega', esc(number_format($bairro->valor_entrega, 2)));?>">
             </div>
             <div class="form-group col-md-3">
									<label for="ativo"> Ativo: <span class="text-danger">*</span> </label>
                  <select class="form-control form-control-ativo" name="ativo" required>
                     <?php if($bairro->id): ?>
                       <option value="1"<?php echo ($bairro->ativo ? 'selected' : ''); ?>>Sim</option>
                       <option value="0"<?php echo (!$bairro->ativo ? 'selected' : ''); ?>>Não</option>
                     <?php else : ?>
                       <option value="1" class="text-success">Sim</option>
                       <option value="0" selected="">Não</option>
                     <?php endif ?>
                 </select>
             </div>

           </div>
             <button type="submit" id="btn-salvar" class="btn btn-primary mr-2 btn-sm"><i class=" mdi mdi-content-save btn-icon-prepend mr-1"></i>Salvar
             </button>
