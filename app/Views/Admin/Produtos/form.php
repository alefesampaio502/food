<div class="form-row">
             <div class="form-group col-md-12">
               <label for="nome"> Nome: <span class="text-danger">*</span> </label>
               <input type="text" class="form-control" name="nome" id="nome" value="<?php echo old('name', esc($produto->nome));?>">
             </div>
             <div class="form-group col-md-6">
               <label for="ativo"> Categorias: <span class="text-danger">*</span> </label>
               <select class="form-control form-control-ativo" name="categoria_id" required>
                    <option value="">Escolha a categoria...</option>
                    <?php foreach ($categorias as $categoria): ?>
                      <?php if($produto->id): ?>
                         <option value="<?php echo $categoria->id; ?>" <?php echo ($categoria->id == $produto->categoria_id ? 'selected' : ''); ?>><?php echo esc($categoria->nome); ?></option>
                      <?php else: ?>
                      <option value="<?php echo $categoria->id; ?>"><?php echo esc($categoria->nome); ?></option>
                      <?php endif; ?>
                    <?php endforeach; ?>

              </select>
               </div>
             <div class="form-group col-md-6">
									<label for="ativo"> Ativo: <span class="text-danger">*</span> </label>
                  <select class="form-control form-control-ativo" name="ativo" required>
                     <?php if($produto->id): ?>
                       <option value="1"<?php echo ($produto->ativo ? 'selected' : ''); ?>>Sim</option>
                       <option value="0"<?php echo (!$produto->ativo ? 'selected' : ''); ?>>Não</option>
                     <?php else : ?>
                       <option value="1" class="text-success">Sim</option>
                       <option value="0" selected="">Não</option>
                     <?php endif ?>
                 </select>
             </div>
             <div class="form-group col-md-12">
               <label for="nome">Ingredientes: <span class="text-danger">*</span> </label>
               <textarea class="form-control" name="ingredientes" rows="2" id="ingredientes"><?php echo old('name', esc($produto->ingredientes));?></textarea>
               </div>
           </div>
             <button type="submit" class="btn btn-primary mr-2 btn-sm"><i class=" mdi mdi-content-save btn-icon-prepend mr-1"></i>Salvar
             </button>
