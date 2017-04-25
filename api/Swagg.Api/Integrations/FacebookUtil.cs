using Facebook;
using Newtonsoft.Json;
using Swagg.Api.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Swagg.Api.Integrations
{
    public class FacebookUtil
    {
        public static string PostLink(string accessToken, string url)
        {
            try
            {
                var fb = new FacebookClient(accessToken);
                JsonObject response = fb.Post("/me/feed", new
                {
                    link = url
                }) as JsonObject;

                return response["post_id"] as string;
            }
            catch
            {
                return null;
            }
        }

        public static string PostPromotion(string accessToken, Promotion promo)
        {
            try
            {
                var fb = new FacebookClient(accessToken);
                JsonObject response = null;
                var msg = string.Format("{0}\n\n{1}\n\nhttp://jserv.asuscomm.com/Promo.html?id={2}", promo.Title, promo.Description, promo.PromotionId);
                if (promo.Files.Any())
                    response = fb.Post("/me/photos", new
                    {
                        message = msg,
                        source = new FacebookMediaObject
                        {
                            ContentType = "img/gif",
                            FileName = promo.Files.First().FileName

                        }.SetValue(Convert.FromBase64String(promo.Files.First().FileData))
                    }) as JsonObject;
                else
                {
                    response = fb.Post("/me/feed", new
                    {
                        message = msg
                    }) as JsonObject;
                }

                return response["post_id"] as string;
            }
            catch
            {
                return null;
            }

        }
    }
}