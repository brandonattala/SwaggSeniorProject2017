using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Http;
using System.Web.Http.Controllers;

namespace Swagg.Api.Attributes
{
    public class ApiKeyAuthorizeAttribute : AuthorizeAttribute
    {
        private const string apiKey = "B369BCEF-3C50-4615-8434-326C4FFADB49";

        protected override bool IsAuthorized(HttpActionContext context)
        {
            IEnumerable<string> lsHeaders;
            bool hasKey = context.Request.Headers.TryGetValues("API_KEY", out lsHeaders);

            return hasKey && lsHeaders.FirstOrDefault().Equals(apiKey);
        }
    }
}