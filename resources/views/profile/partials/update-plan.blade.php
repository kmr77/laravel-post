<div class="mt-5">
    <h4 class="mb-3">プラン変更（アドミンユーザーにのみ表示）</h4>
    <x-message :message="session('message')" />
    <table class="text-left w-full border-collapse mt-8"> 
        <tr class="bg-green-600 text-center">
            <th>Aプラン</th>
            <th>Bプラン</th>
            <th>Cプラン</th>
        </tr>
    
        <tr class="bg-white text-center">
            <td class="p-3">
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox plan-checkbox" data-plan="aplan" {{ $user->aplan == 1 ? 'checked' : '' }}>
                </label>
            </td>
            <td class="p-3">
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox plan-checkbox" data-plan="bplan" {{ $user->bplan == 1 ? 'checked' : '' }}>
                </label>
            </td>
            <td class="p-3">
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox plan-checkbox" data-plan="cplan" {{ $user->cplan == 1 ? 'checked' : '' }}>
                </label>
            </td>
        </tr>
    </table>
</div>
    
    <script>
        const checkboxes = document.querySelectorAll('.plan-checkbox');
    
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', async () => {
                const userId = {{ $user->id }};
                const plans = {};
    
                checkboxes.forEach(cb => {
                    plans[cb.getAttribute('data-plan')] = cb.checked ? 1 : 0;
                });
    
                try {
                    const response = await axios.patch(`/profile/planupdate/${userId}`, plans);
    
                    console.log(response.data);
                    alert('プランを更新しました。');
                    // プラン情報が更新された後の処理を記述
                } catch (error) {
                    console.error(error);
                }
            });
        });
    </script>
