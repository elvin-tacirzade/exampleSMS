<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0",
 *         title="ExampleSMS Api",
 *     )
 * )
 * @OA\SecurityScheme(
 * securityScheme="bearerAuth",
 * type="http",
 * scheme="bearer"
 * )
 * @OA\Post(
 * path="/api/register",
 * tags={"ExampleSMS"},
 * description="Follow the steps below to register.",
 *     @OA\RequestBody(
 *         @OA\JsonContent(),
 *         @OA\MediaType(
 *            mediaType="multipart/form-data",
 *            @OA\Schema(
 *               type="object",
 *               required={"name", "email", "password", "password_confirm"},
 *               @OA\Property(property="name", type="text"),
 *               @OA\Property(property="email", type="text"),
 *               @OA\Property(property="password", type="password"),
 *               @OA\Property(property="password_confirm", type="password"),
 *            ),
 *        ),
 *    ),
 *      @OA\Response(
 *          response=201,
 *          description="Created",
 *          @OA\JsonContent(
 *             @OA\Examples(example="result", value={"status": "success", "message" : "You have successfully registered."}, summary="An result object."),
 *         )
 *       ),
 *     @OA\Response(
 *          response=400,
 *          description="Bad Request",
 *          @OA\JsonContent(
 *             @OA\Examples(example="result", value={"email" : "The email must be a valid email address."}, summary="An result object."),
 *         )
 *      ),
 * )
 * @OA\Post(
 * path="/api/login",
 * tags={"ExampleSMS"},
 * description="Follow the steps below to login.",
 *     @OA\RequestBody(
 *         @OA\JsonContent(),
 *         @OA\MediaType(
 *            mediaType="multipart/form-data",
 *            @OA\Schema(
 *               type="object",
 *               required={"email", "password"},
 *               @OA\Property(property="email", type="text"),
 *               @OA\Property(property="password", type="password"),
 *            ),
 *        ),
 *    ),
 *      @OA\Response(
 *          response=200,
 *          description="Success",
 *          @OA\JsonContent(
 *             @OA\Examples(example="result", value={"status": "success", "message" : "You have successfully logged in.", "authorization": {"access_token": "Your Token", "token_type": "bearer", "expires_in": 60}}, summary="An result object."),
 *         )
 *       ),
 *     @OA\Response(
 *          response=400,
 *          description="Bad Request",
 *          @OA\JsonContent(
 *             @OA\Examples(example="result", value={"email" : "The email must be a valid email address."}, summary="An result object."),
 *         )
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthorized",
 *          @OA\JsonContent(
 *             @OA\Examples(example="result", value={"status": "error", "message" : "Invalid credentials."}, summary="An result object."),
 *         )
 *      ),
 * )
 * @OA\Post(
 * path="/api/messages/new",
 * tags={"ExampleSMS"},
 * description="To send a new message follow the steps below.",
 * security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         @OA\JsonContent(),
 *         @OA\MediaType(
 *            mediaType="multipart/form-data",
 *            @OA\Schema(
 *               type="object",
 *               required={"message"},
 *               @OA\Property(property="message", type="textarea"),
 *            ),
 *        ),
 *    ),
 *      @OA\Response(
 *          response=201,
 *          description="Created",
 *          @OA\JsonContent(
 *             @OA\Examples(example="result", value={"status": "success", "message" : "Message sent successfully."}, summary="An result object."),
 *         )
 *       ),
 *     @OA\Response(
 *          response=400,
 *          description="Bad Request",
 *          @OA\JsonContent(
 *             @OA\Examples(example="result", value={"message" : "The message field is required."}, summary="An result object."),
 *         )
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthorized",
 *          @OA\JsonContent(
 *             @OA\Examples(example="result", value={"status": "error", "message" : "Unauthenticated"}, summary="An result object."),
 *         )
 *       ),
 * )
 * @OA\Get(
 * path="/api/messages/show",
 * tags={"ExampleSMS"},
 * description="Follow the steps below to see your messages.",
 * security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         in="query",
 *         name="date",
 *         @OA\Schema(type="string")
 *     ),
 *      @OA\Response(
 *          response=200,
 *          description="Success",
 *          @OA\JsonContent(
 *             @OA\Examples(example="result", value={"status": "success", "data" :  {"id": 1,"message": "test message","created_at": "timestamp"},}, summary="An result object."),
 *         )
 *       ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthorized",
 *          @OA\JsonContent(
 *             @OA\Examples(example="result", value={"status": "error", "message" : "Unauthenticated"}, summary="An result object."),
 *         )
 *       ),
 * )
 * @OA\Get(
 * path="/api/messages/show/{id}",
 * tags={"ExampleSMS"},
 * description="Follow the steps below to see your message.",
 * security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *      @OA\Response(
 *          response=200,
 *          description="Success",
 *          @OA\JsonContent(
 *             @OA\Examples(example="result", value={"status": "success", "data" :  {"id": 1,"message": "test message","created_at": "timestamp"},}, summary="An result object."),
 *         )
 *       ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthorized",
 *          @OA\JsonContent(
 *             @OA\Examples(example="result", value={"status": "error", "message" : "Unauthenticated"}, summary="An result object."),
 *         )
 *       ),
 *      @OA\Response(
 *          response=404,
 *          description="Not Found",
 *          @OA\JsonContent(
 *             @OA\Examples(example="result", value={"status": "error", "message" : "The data not found"}, summary="An result object."),
 *         )
 *       ),
 * )
 * @OA\Get(
 * path="/api/logout",
 * tags={"ExampleSMS"},
 * description="Follow the steps below to logout.",
 * security={{"bearerAuth":{}}},
 *      @OA\Response(
 *          response=200,
 *          description="Success",
 *          @OA\JsonContent(
 *             @OA\Examples(example="result", value={"status": "success", "message" : "User successfully logged out."}, summary="An result object."),
 *         )
 *       ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthorized",
 *          @OA\JsonContent(
 *             @OA\Examples(example="result", value={"status": "error", "message" : "Unauthenticated"}, summary="An result object."),
 *         )
 *       ),
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
