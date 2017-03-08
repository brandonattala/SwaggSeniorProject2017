using System;
using System.Threading.Tasks;
using Microsoft.Owin;
using Owin;
using Hangfire;
using Swagg.Api.Models;

[assembly: OwinStartup(typeof(Swagg.Api.Startup))]

namespace Swagg.Api
{
    public class Startup
    {
        public void Configuration(IAppBuilder app)
        {
            using (var db = new SwaggDbContext())
            {
                GlobalConfiguration.Configuration.UseSqlServerStorage(db.Database.Connection.ConnectionString);
            }
            app.UseHangfireDashboard();
            app.UseHangfireServer();
        }
    }
}
