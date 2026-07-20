<!-- MODAL DOCUMENTOS -->
<div
    id="modalDocumentos"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl mx-4 max-h-[90vh] flex flex-col">
        <!-- HEADER -->
        <div class="flex items-center justify-between px-6 py-5 border-b">
            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Documentos
                </h2>
                <p
                    id="tituloDocumento"
                    class="text-sm text-slate-500">
                </p>
            </div>
            <button
                type="button"
                id="cerrarModalDocumentos"
                class="text-slate-400 hover:text-slate-600">
                <i class="bi bi-x-lg text-xl"></i>
            </button>
        </div>
        <form
            id="formDocumento"
            method="POST"
            action="index.php?url=documento_store"
            enctype="multipart/form-data">
            <input
                type="hidden"
                id="idInversionDocumento"
                name="idInversiones">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
                    <!-- Tipo -->
                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Tipo de documento
                        </label>
                        <select
                            id="tipoDocumento"
                            name="tipoDocumento"
                            class="w-full rounded-lg border px-4 py-2.5"
                            required>
                            <option value="">Seleccionar</option>
                            <option value="Expediente Técnico">Expediente Técnico</option>
                            <option value="Bases">Bases</option>
                            <option value="Contrato">Contrato</option>
                            <option value="Informe">Informe</option>
                            <option value="Acta">Acta</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <!-- Archivo -->
                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Archivo PDF
                        </label>
                        <input
                            type="file"
                            id="archivo"
                            name="archivo"
                            accept="application/pdf"
                            class="w-full rounded-lg border px-4 py-2.5"
                            required>
                    </div>
                    <!-- Observación -->
                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Observación
                        </label>
                        <input
                            type="text"
                            id="observacionDocumento"
                            name="observacion"
                            class="w-full rounded-lg border px-4 py-2.5">
                    </div>
                </div>
                <!-- TABLA -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="px-5 py-3 border-b bg-slate-50">
                        <h3 class="text-sm font-semibold text-slate-700">
                            Documentos registrados
                        </h3>
                    </div>
                    <div class="max-h-[250px] overflow-y-auto overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="sticky top-0 bg-white border-b">
                                <tr class="text-left text-slate-500">
                                    <th class="px-4 py-2 w-16 text-center">N°</th>
                                    <th class="px-4 py-2">Tipo</th>
                                    <th class="px-4 py-2">Archivo</th>
                                    <th class="px-4 py-2">Fecha</th>
                                    <th class="px-4 py-2 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="listaDocumentos">
                                <!-- AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-3 px-6 py-3 bg-slate-50">
                <button
                    type="button"
                    id="cancelarModalDocumentos"
                    class="px-5 py-2.5 border rounded-lg">
                    Cancelar
                </button>
                <button
                    type="submit"
                    class="px-5 py-2.5 bg-blue-600 text-white rounded-lg">
                    <i class="bi bi-upload"></i>
                    Subir documento
                </button>
            </div>
        </form>
    </div>
</div>