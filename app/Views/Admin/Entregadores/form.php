      <div class="form-row">
             <div class="form-group col-md-4">
               <label for="nome"> Nome: <span class="text-danger">*</span> </label>
               <input type="text" class="form-control" name="nome" id="nome" value="<?php echo old('name', esc($entregador->nome));?>">
             </div>
             <div class="form-group col-md-3">
               <label for="cpf"> CPF: <span class="text-danger">*</span> </label>
               <input type="text" class="form-control cpf" id="cpf" name="cpf" value="<?php echo old('cpf', esc($entregador->cpf));?>">
             </div>
             <div class="form-group col-md-2">
               <label for="cpf"> CNH: <span class="text-danger">*</span> </label>
               <input type="text" class="form-control cnh" id="cnh" name="cnh" value="<?php echo old('cpf', esc($entregador->cnh));?>">
             </div>
             <div class="form-group col-md-3">
               <label for="telefone">Telefone</label>
               <input type="text" class="form-control phone_with_ddd" id="telefone"
               name="telefone" value="<?php echo old('telefone', esc($entregador->telefone));?>">
             </div>
             <div class="form-group col-md-3">
               <label for="email"> Email: <span class="text-danger">*</span> </label>
               <input type="email" class="form-control"name="email" id="email" value="<?php echo old('email', esc($entregador->email));?>">
             </div>
             <div class="form-group col-md-3">
               <label for="veiculo">Veículo</label>
               <input type="text" class="form-control " id="veiculo"
               name="veiculo" value="<?php echo old('veiculo', esc($entregador->veiculo));?>">
             </div>

             <div class="form-group col-md-3">
               <label for="placa">Placa</label>
               <input type="text" class="form-control placa" id="placa"
               name="placa" value="<?php echo old('placa', esc($entregador->placa));?>">
             </div>

             <div class="form-group col-md-3">
									<label for="ativo"> Ativo: <span class="text-danger">*</span> </label>
                  <select class="form-control form-control-ativo" name="ativo" required>
                     <?php if($entregador->id): ?>
                       <option value="1" <?php echo ($entregador->ativo ? 'selected' : ''); ?>>Sim</option>
                       <option value="0" <?php echo (!$entregador->ativo ? 'selected' : ''); ?>>Não</option>
                     <?php else : ?>
                       <option value="1" class="text-success">Sim</option>
                       <option value="0" selected="">Não</option>
                     <?php endif ?>
                 </select>
             </div>
             <div class="form-group col-md-12 mb-5">
               <label for="placa">Endereço</label>
               <input type="text" class="form-control " id="endereco"
               name="endereco" value="<?php echo old('endereco', esc($entregador->endereco));?>">
             </div>
           </div>
             <button type="submit" class="btn btn-primary mr-2 btn-smmt-"><i class=" mdi mdi-content-save btn-icon-prepend mr-1"></i>Salvar
             </button>
