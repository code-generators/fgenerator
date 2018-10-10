
namespace App\Http\Controllers;

class BaseController extends Controller
{
    /**
     * 请求成功
     * @author
     *
     * @param $data
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiSuccess($data, $message = "请求成功")
    {
        return response()->json([
            'code' => 1,
            'data' => $data,
            'message' => $message
        ], 200, ['Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate', 'Pragma' => 'no-cache', 'Expires' => -1], JSON_NUMERIC_CHECK);
    }

    /**
     * 请求失败
     * @author
     *
     * @param $message
     * @param int $code
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiFail($message, $code = -1, $data = [])
    {
        return response()->json([
            'code' => $code,
            'data' => $data,
            'message' => $message
        ], 200, [], JSON_NUMERIC_CHECK);
    }
}